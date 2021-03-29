export default class ErrorList {
    // Private field that will hold array of error messages.
    #errors;

    /***********************************************************************
     *
     * Function Name: ErrorList()
     * Purpose: Acts as a default constructor for the ErrorList class. This
     *          will instantiate the private #errors field with an empty
     *          array.
     * Precondition: N/A.
     * Postcondition: The new ErrorList object is initialized.
     *
     **********************************************************************/
    constructor() {
        this.#errors = [];
    }

    /**********************************************************************
     *
     * Function Name: ErrorList.addError().
     * Purpose: Adds a new error message to the array of error messages.
     * Precondition: N/A.
     * Postcondition: A new error message is added to the #errors array.
     *
     ********************************************************************/
    addError(message) {
        this.#errors.append(message);
    }

    /*********************************************************************
     *
     * Function Name: ErrorList.deleteError(message).
     * Purpose: Removes an error from the #errors array if it exists.
     * Precondition: The error message must exist within the #errors array.
     * Postcondition: The error message is removed from the array.
     *
     ********************************************************************/
    deleteError(message) {
        this.#errors = this.#errors.filter((error) => error != message);
    }

}
