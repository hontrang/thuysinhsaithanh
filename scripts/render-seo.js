'use strict';
const fs = require('fs');
const packageJSON = require('../package.json');
const upath = require('upath');
const sh = require('shelljs');

module.exports = function renderSEO(filePath) {

    const destPath = upath.resolve(upath.dirname(__filename), '../dist/' + upath.basename(filePath));
    const destPathDirname = upath.dirname(destPath);
    if (!sh.test('-e', destPathDirname)) {
        sh.mkdir('-p', destPathDirname);
    }
    
    const content = fs.readFileSync(filePath);
    
    fs.writeFileSync(destPath, content);
};