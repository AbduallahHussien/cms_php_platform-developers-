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
