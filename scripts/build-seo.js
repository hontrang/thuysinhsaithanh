'use strict';

const renderSEO = require('./render-seo');
const upath = require('upath');
const sh = require('shelljs');

const srcPath = upath.resolve(upath.dirname(__filename), '../src');

sh.find(srcPath).forEach(_processFile);

function _processFile(filePath) {
    if (
        filePath.match(/\.(xml|txt)$/)
    ) {
        renderSEO(filePath);
    }
}