const { test, expect } = require('@playwright/test');

test('All internal links should be reachable', async ({ page }) => {
  await page.goto('http://localhost:3000');
  const links = await page.$$eval('a', as => as.map(a => a.href));

  for (const href of links) {
    // Only test links that start with localhost
    if (href.startsWith('http://localhost:3000')) {
      const response = await page.request.get(href);
      console.log(`Checking ${href} → status ${response.status()}`);
      expect(response.status()).toBeLessThan(400);
    } else {
      console.log(`Skipping external link: ${href}`);
    }
  }
});



test('All images should have alt attributes', async ({ page }) => {
  await page.goto('http://localhost:3000');
  const images = await page.$$eval('img', imgs =>
    imgs.map(img => img.hasAttribute('alt'))
  );
  for (const hasAlt of images) {
    expect(hasAlt).toBe(true);
  }
});
