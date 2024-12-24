function applyTheme(settings) {
    document.documentElement.style.setProperty('--background-color', settings.background_color);
    if (settings.background_image) {
        document.documentElement.style.setProperty(
            '--background-image',
            `url(${settings.background_image})`
        );
    }
}
