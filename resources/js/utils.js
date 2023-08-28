export const buildQueryParams = (params) => {
    const esc = encodeURIComponent;
    return Object.keys(params)
        .map(key => esc(key) + '=' + esc(params[key]))
        .join('&');
}
