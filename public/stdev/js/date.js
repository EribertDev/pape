/**
 * Extracts and formats the date and time from an ISO 8601 string.
 *
 * @param {string} isoString - The ISO 8601 date string to be parsed (e.g., "2024-08-24T22:31:22.000000Z").
 * @param {string} [dateFormat="YYYY-MM-DD"] - The desired format for the date (default is "YYYY-MM-DD").
 *  - "YYYY" will be replaced by the 4-digit year.
 *  - "MM" will be replaced by the 2-digit month.
 *  - "DD" will be replaced by the 2-digit day.
 * @param {string} [timeFormat="HH:mm:ss"] - The desired format for the time (default is "HH:mm:ss").
 *  - "HH" will be replaced by the 2-digit hour.
 *  - "mm" will be replaced by the 2-digit minutes.
 *  - "ss" will be replaced by the 2-digit seconds.
 *
 * @returns {Object} An object containing the formatted date and time.
 * @returns {string} return.date - The formatted date string.
 * @returns {string} return.time - The formatted time string.
 *
 * @example
 * // Example usage with default format:
 * const isoString = "2024-08-24T22:31:22.000000Z";
 * const result = extractDateTime(isoString);
 * console.log(result.date); // Outputs: "2024-08-24"
 * console.log(result.time); // Outputs: "22:31:22"
 *
 * @example
 * // Example usage with custom format:
 * const customResult = extractDateTime(isoString, "DD/MM/YYYY", "HH:mm");
 * console.log(customResult.date); // Outputs: "24/08/2024"
 * console.log(customResult.time); // Outputs: "22:31"
 */
export function extractDateTime(isoString, dateFormat = "YYYY-MM-DD", timeFormat = "HH:mm:ss") {
    // Convertir la chaîne ISO en un objet Date
    const dateObj = new Date(isoString);

    // Extraire les différentes parties de la date et de l'heure
    const year = dateObj.getUTCFullYear();
    const month = String(dateObj.getUTCMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
    const day = String(dateObj.getUTCDate()).padStart(2, '0');

    const hours = String(dateObj.getUTCHours()).padStart(2, '0');
    const minutes = String(dateObj.getUTCMinutes()).padStart(2, '0');
    const seconds = String(dateObj.getUTCSeconds()).padStart(2, '0');

    // Remplacer les parties du format de la date
    const dateFormatted = dateFormat
        .replace("YYYY", year)
        .replace("MM", month)
        .replace("DD", day);

    // Remplacer les parties du format de l'heure
    const timeFormatted = timeFormat
        .replace("HH", hours)
        .replace("mm", minutes)
        .replace("ss", seconds);

    return {
        date: dateFormatted,
        time: timeFormatted
    };
}
