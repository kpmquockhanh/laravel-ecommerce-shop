import {buildQueryParams} from "./utils";

const doRequest = async (method, url, data = null) => {
    try {
        return await axios({
            method: method,
            url: url,
            data: data
        })
            .then(response => {
                return response.data;
            })
            .catch(error => {
                if (error.response.status === 404) {
                    console.log('not found')
                }
                throw error;
            });
    } catch (e) {
        console.log('error', e)
        return {
            error: e.message,
            status: e.response.status,
        }
    }
}

export const doGet = async (url, queryObj = {}) => {
    if (Object.keys(queryObj).length) {
        const query = buildQueryParams(queryObj)
        url = `${url}?${query}`
    }
    console.log('kpm', url)
    const resp = await doRequest('get', url);
    console.log('resp', resp)
    return resp
}

export const doPost = (url, {query, data}) => {
    const q = buildQueryParams(query)
    return doRequest('post', `${url}?${query}`, data);
}
