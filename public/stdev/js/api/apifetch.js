
/**
 *
 * @param url
 * @param options
 * @returns {Promise<any>}
 */
export async function fetchJson( options = {}) {
    const headers = { Accept: 'application/json;charset=utf-8', ...options.headers };
    const response = await fetch(options.url, { ...options, headers });

    if (!response.ok) {
        const errorMessage = `Server error: ${response.statusText}`;
        throw new Error(errorMessage,{cause:response});
    }
    return response.json();
}

export async function fetchData(options = {}) {
    try {
        // URL
        if (!options.hasOwnProperty("url")) {
            throw new Error("option.url not defined");
        }
        if (typeof options.url !== "string") {
            throw new Error("option.url must be a string");
        }

        // Méthode
        options.method = options.hasOwnProperty("method") ? options.method : "GET";
        if (typeof options.method !== "string") {
            throw new Error("method option should be string");
        }

        // Headers
        options.headers = options.hasOwnProperty("headers") ? options.headers : { Accept: 'application/json;charset=utf-8' };
        if (typeof options.headers !== "object") {
            throw new Error("headers option should be object");
        }

        // Body
        options.body = options.hasOwnProperty("body") ? options.body : null;

        // ResponseType
        options.responseType = options.hasOwnProperty("responseType") ? options.responseType : 'text';
        if (typeof options.responseType !== "string") {
            throw new Error("options.responseType should be string");
        }

        const url = options.url;
        delete options.url;

        console.log(options.headers);

        // Envoi de la requête
        const response = await fetch(url, options);
        if (!response.ok) {
            const errorMessage = `Server error: ${response.status} ${response.statusText}`;
            throw new Error(errorMessage,{cause:response});
        }

        switch (options.responseType.toLowerCase()) {
            case 'json':
                return await response.json();
            case 'text':
                return await response.text();
            case 'blob':
                return await response.blob();
            case 'arraybuffer':
                return await response.arrayBuffer();
            case 'formdata':
                return await response.formData();
            default:
                throw new Error('Unsupported response type');
        }

    } catch (e) {
        console.error(e);
        throw e; // Relancer l'erreur pour permettre à l'appelant de la gérer
    }
}
