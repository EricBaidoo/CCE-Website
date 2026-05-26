const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        if (isDirectory) {
            walkDir(dirPath, callback);
        } else {
            callback(dirPath);
        }
    });
}

const targetExtensions = ['.css', '.php'];

walkDir(__dirname, (filePath) => {
    const ext = path.extname(filePath);
    if (!targetExtensions.includes(ext)) return;

    let content = fs.readFileSync(filePath, 'utf8');
    let modified = false;

    // Regular expression to match px values in CSS/Tailwind contexts
    // We only want to match numbers followed by 'px'
    // Exclude matches that look like base64 or inside svg coords if possible, but the regex `(-?\d+(?:\.\d+)?)px\b` is pretty safe for CSS.
    // We will replace Xpx with (X/16)rem. If X is 0, just leave as 0.
    const pxRegex = /(-?\d+(?:\.\d+)?)px\b/g;

    const newContent = content.replace(pxRegex, (match, p1) => {
        const val = parseFloat(p1);
        if (val === 0) return '0';
        // Convert to rem
        let remVal = val / 16;
        // Strip trailing zeros if necessary, format to max 4 decimal places
        remVal = parseFloat(remVal.toFixed(4));
        return `${remVal}rem`;
    });

    if (newContent !== content) {
        fs.writeFileSync(filePath, newContent, 'utf8');
        console.log(`Updated ${filePath}`);
    }
});

console.log("Done");
