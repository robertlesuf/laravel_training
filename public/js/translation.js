var translations = {
    'en': {
        'add': 'Add',
        'View more': 'View'
    },
}

function trans(key) {
    if (key in translations['en']) {
        return translations['en'][key];
    }
    return key;
}