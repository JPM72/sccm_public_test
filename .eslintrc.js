module.exports = {
    "env": {
        "browser": true,
        "es2022": true,
        "node": true
    },
    "extends": "eslint:recommended",
    "parserOptions": {
        "ecmaVersion": 13,
        "sourceType": "module"
    },
    "rules": {
        "no-unused-vars": "off",
        "for-direction":"error",
        "no-cond-assign": "error",
        "no-dupe-else-if": "error",
        "no-duplicate-case": "error",
    }
};
