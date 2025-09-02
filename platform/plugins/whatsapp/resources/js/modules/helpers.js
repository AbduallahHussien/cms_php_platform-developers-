/**
 * Converts a Unix timestamp (in seconds) to a formatted 12-hour time with AM/PM.
 * @param {number} timestamp - Unix timestamp in seconds.
 * @returns {string} Formatted time, e.g. "02:05 PM".
 */
export const convertTime = (timestamp) => {
    if (typeof timestamp !== "number" || !Number.isFinite(timestamp)) {
        throw new TypeError("Timestamp must be a finite number");
    }

    const date = new Date(timestamp * 1000);
    let hours = date.getHours();
    const minutes = String(date.getMinutes()).padStart(2, "0");
    const amPm = hours >= 12 ? "PM" : "AM";

    // Convert to 12-hour format
    hours = hours % 12 || 12;

    return `${hours}:${minutes} ${amPm}`;
};

export const convertDateTime = (timestamp) => {
    if (typeof timestamp !== "number" || !Number.isFinite(timestamp)) {
        throw new TypeError("Timestamp must be a finite number");
    }

    const date = new Date(timestamp * 1000);

    // Format date parts
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0"); // months are 0-based
    const day = String(date.getDate()).padStart(2, "0");

    // Format time parts
    let hours = date.getHours();
    const minutes = String(date.getMinutes()).padStart(2, "0");
    const amPm = hours >= 12 ? "PM" : "AM";

    hours = hours % 12 || 12; // convert to 12-hour format

    // Final format: YYYY-MM-DD HH:MM AM/PM
    return `${year}-${month}-${day} ${hours}:${minutes} ${amPm}`;
};

export const truncateText = (text, length = 50) => {
    if (typeof text !== "string") return "";

    return text.length > length 
        ? text.substring(0, length) + "…" 
        : text;
};


export const sanitizeKey = (key) => (key.replace(/[.#$[\]]/g, "_"));
  