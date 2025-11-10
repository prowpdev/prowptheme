const chokidar = require('chokidar');
const { exec } = require('child_process');
const path = require('path');

// Path to your blocks folder
const blocksDir = path.join(__dirname, '..', 'blocks');

// Watch for new directories
const watcher = chokidar.watch(blocksDir, {
  ignored: /(^|[\/\\])\../, // ignore hidden files
  persistent: true,
  depth: 1, // only watch direct children of blocks
  ignoreInitial: true, // ignore existing folders on startup
});

watcher.on('addDir', (folderPath) => {
  const blockName = path.basename(folderPath);
  console.log(`Detected new block folder: ${blockName}`);

  // Run your create-blocks script
  exec('npm run create-blocks', (err, stdout, stderr) => {
    if (err) {
      console.error('Error creating block files:', err);
      return;
    }
    console.log(stdout);
    if (stderr) console.error(stderr);
  });
});

console.log(`Watching for new block folders in ${blocksDir}...`);
