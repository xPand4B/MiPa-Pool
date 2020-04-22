module.exports = {
    "moduleFileExtensions": [
        "js",
        "json",
        "vue"
    ],
    "testMatch": [
        "<rootDir>/app/**/*.(spec|test).(js|jsx|ts|tsx)",
    ],
    "transform": {
        "^.+\\.vue$": "vue-jest",
        "^.+\\.(js|jsx)?$": "babel-jest"
    }
};