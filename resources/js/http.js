import {buildQueryParams} from "./utils";

const doRequest = (method, url, data = null) => {
    return axios({
        method: method,
        url: url,
        data: data
    })
        .then(response => {
            return response.data;
        })
        .catch(error => {
            return error.response.data;
        });
}

export const doGet = (url, queryObj = {}) => {
    if (Object.keys(queryObj).length === 0) {
        return doRequest('get', url);
    }
    const query = buildQueryParams(queryObj)
    return doRequest('get', `${url}?${query}`);
}

export const doPost = (url, {query, data}) => {
    const q = buildQueryParams(query)
    return doRequest('post', `${url}?${query}`, data);
}
