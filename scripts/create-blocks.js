const fs = require('fs');
const path = require('path');

// Path to your blocks directory
const blocksDir = path.join(__dirname, '..', 'blocks'); // adjust if script is inside theme root

// Default templates
const defaultBlockJson = (name) => `{
  "name": "acf/${name}",
  "title": "${name.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}",
  "description": "A custom ${name} block",
  "category": "layout",
  "icon": "admin-customizer",
  "keywords": ["${name}"],
  "acf": {
    "mode": "preview",
    "renderTemplate": "render.php"
  },
  "supports": {
    "align": ["wide", "full"],
    "anchor": true
  }
}`;

// Make render.php a function that dynamically includes the block name
const defaultRenderPhp = (name) => `<?php
// ACF fields for this block can be used like:
// get_field('field_name');
?>

<section class="block-${name}">
  <!-- Add your HTML here -->
</section>
`;

const defaultStyleCss = `/* Tailwind or custom CSS for this block */\n`;

// Scan blocks folder
fs.readdir(blocksDir, { withFileTypes: true }, (err, files) => {
    if (err) {
        console.error('Error reading blocks directory:', err);
        process.exit(1);
    }

    files.forEach(file => {
        if (file.isDirectory()) {
            const blockName = file.name;
            const blockPath = path.join(blocksDir, blockName);

            const jsonPath = path.join(blockPath, 'block.json');
            const phpPath = path.join(blockPath, 'render.php');
            const cssPath = path.join(blockPath, 'style.css');

            // Create block.json if missing
            if (!fs.existsSync(jsonPath)) {
                fs.writeFileSync(jsonPath, defaultBlockJson(blockName));
                console.log(`Created: ${jsonPath}`);
            }

            // Create render.php if missing
            if (!fs.existsSync(phpPath)) {
                fs.writeFileSync(phpPath, defaultRenderPhp(blockName));
                console.log(`Created: ${phpPath}`);
            }

            // Create style.css if missing
            if (!fs.existsSync(cssPath)) {
                fs.writeFileSync(cssPath, defaultStyleCss);
                console.log(`Created: ${cssPath}`);
            }
        }
    });
});
