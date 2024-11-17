/**
 *fonction pour caché un élément par son id dans le dom
 * @param idHtmlElement
 */
export function hideElement(idHtmlElement) {
    idHtmlElement.style.display = 'none'
}

/**
 * fonction pour afficher un élément par son id dans le dom
 * @param idHtmlElement
 */
export function showElement(idHtmlElement) {
    idHtmlElement.style.display = 'block';
}

/**
 * Supprime une ou plusieurs classes d'un élément en utilisant son id
 * @param {string} elementId - L'id de l'élément duquel retirer les classes
 * @param {string} classes - Une chaîne de classes séparées par des espaces
 */
export function removeClass(elementId, classes) {
    const element = document.getElementById(elementId);
    if (element && element.classList) {
        if (typeof classes === 'string') {
            // Diviser la chaîne de classes en un tableau de noms de classes
            const classArray = classes.split(/\s+/).filter(Boolean);

            // Retirer chaque classe
            classArray.forEach(className => element.classList.remove(className));
        } else {
           // console.error('Le paramètre "classes" doit être une chaîne de caractères.');
        }
    }
}

/**
 * Ajoute une ou plusieurs classes à un élément
 * @param {string} elementId - L'élément auquel ajouter les classes
 * @param {...string} classes - Une ou plusieurs classes à ajouter
 */
export function addClass(elementId, classes) {
    const element = document.getElementById(elementId);
    if (element && element.classList) {
        if (typeof classes === 'string') {
            // Diviser la chaîne de classes en un tableau de noms de classes
            const classArray = classes.split(/\s+/).filter(Boolean);

            // Retirer chaque classe
            classArray.forEach(className => element.classList.add(className));
        } else {
           // console.error('Le paramètre "classes" doit être une chaîne de caractères.');
        }
    }
}

/**
 * Truncate a string to a specified maximum length and append an ellipsis ("...") if necessary.
 *
 * @param {string} str - The string to be truncated.
 * @param {number} maxLength - The maximum length of the truncated string, including the ellipsis.
 * @returns {string} - The truncated string if it exceeds the maximum length, otherwise the original string.
 *
 * @example
 * // Returns "Hello..."
 * truncateString("Hello, world!", 8);
 *
 * @example
 * // Returns "Hello"
 * truncateString("Hello", 10);
 */
export function truncateString(str, maxLength) {
    return str.length > maxLength ? str.substring(0, maxLength - 3) + "..." : str;
}

/**
 * Capitalize the first letter of a string.
 *
 * @param {string} string - The string to capitalize.
 * @returns {string} - The string with the first letter capitalized.
 *
 * @example
 * // Returns "Hello"
 * capitalizeFirstLetter("hello");
 *
 * @example
 * // Returns "World"
 * capitalizeFirstLetter("world");
 */
export function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/**
 * Generate a random alphanumeric string of a specified length.
 *
 * @param {number} length - The length of the random string to be generated.
 * @returns {string} - A randomly generated string consisting of uppercase letters, lowercase letters, and digits.
 *
 * @example
 * // Returns a random string like "A1b2C3d4E5"
 * generateRandomString(10);
 *
 * @example
 * // Returns a random string like "ZyXwV"
 * generateRandomString(5);
 */
export function generateRandomString(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    const charactersLength = characters.length;
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
// Fonction pour stocker une valeur dans le localStorage
export function setLocalStorage(key, value) {
    // Convertir la valeur en JSON pour stocker des objets complexes
    localStorage.setItem(key, JSON.stringify(value));
}
// Fonction pour récupérer une valeur du localStorage
export function getLocalStorage(key) {
    const storedValue = localStorage.getItem(key);
    // Vérifier si la valeur existe et la renvoyer sous forme d'objet ou de chaîne
    return storedValue ? JSON.parse(storedValue) : null;
}
// Fonction pour vider tout le contenu du localStorage
export function clearLocalStorage() {
    localStorage.clear();
}


export function info() {
    console.log("%cSite créé par: %cSilas M. DAKO\n%cDéveloppeur Full Stack & Système Embarqué\nPassionné par les solutions numériques et doté de plus de 3 ans d'expérience, je suis enthousiaste 🤩 à l'idée de partager avec vous mes projets et mon parcours. 💻\nQue vous soyez ici pour explorer mes compétences en développement web, en conception d'applications 📱 ou en design graphique 🎨, j'espère que vous apprécierez ce voyage au cœur de mon univers numérique. 🤝\nN'hésitez pas à me contacter pour toute collaboration ou pour échanger des idées ! 🚀\nNuméro de téléphone: +229 91162617\nLien LinkedIn: https://www.linkedin.com/in/m-silas-dako-stdev-%F0%9F%92%BB%F0%9F%91%A8%E2%80%8D%F0%9F%92%BB-40b91125b/",
        "color: white; font-weight: bold;",
        "color: white; background-color: #007BFF; font-weight: bold;",
        "color: white; font-weight: bold;");

}
