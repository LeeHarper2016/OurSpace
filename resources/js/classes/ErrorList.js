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

}
