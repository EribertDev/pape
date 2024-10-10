//const Text = require('../stdev/js/javascript-form-validation/src/lib/TextField.js');
import {TextField} from "./form-validation/TextField.js";
import {EmailField} from "./form-validation/EmailField.js";
import {PasswordField} from "./form-validation/PasswordField.js";
import {NoDigitsField} from "./form-validation/NoDigitsField.js";
import {DigitsField} from "./form-validation/DigitsField.js";
import {addClass, capitalizeFirstLetter, removeClass} from "./StdeUsefulFunction.js";


export class StdevForm{
    formData;
    #formElement;
    #response;
    #formIsValid;
    _formData;
   constructor() {
        this.#response = {};
        this.#formIsValid=false;
    }
    /**
     * @param {HTMLFormElement} formElement
     */
    setFormElement(formElement) {
        this.#formElement = formElement;
        this.formData = new FormData(formElement);
        this._formData = this.formData;
        this.#response = {};
    }
    checkFormValidation(fieldsConfig){
        //    fieldsConfig[field].typeField = undefined;
        let _field;
        //console.log(fieldsConfig);
        for (let field in fieldsConfig) {
            let resp = this.#response[`isValid${field.charAt(0).toUpperCase() + field.slice(1)}`]={};
            if (fieldsConfig[field].typeField.hasOwnProperty("textField")){
                let fieldValue = this.formData.get(fieldsConfig[field].name);
                _field = new TextField(fieldsConfig[field].typeField.textField.minLength,fieldsConfig[field].typeField.textField.maxLength);
                resp.text =_field.isValid(fieldValue);
            }
            if (fieldsConfig[field].typeField.hasOwnProperty("noDigitsField")){
                if(typeof fieldsConfig[field].typeField.noDigitsField !== "boolean"){
                    throw "noDigitsField option should be boolean";
                }else {
                    if (fieldsConfig[field].typeField.noDigitsField){
                        let fieldValue = this.formData.get(fieldsConfig[field].name);
                        _field = new NoDigitsField()
                        this.#response[`isValid${field.charAt(0).toUpperCase() + field.slice(1)}`].NoDigits =_field.isValid(fieldValue);
                    }
                }
            }
            if (fieldsConfig[field].typeField.hasOwnProperty("emailField")){
                if(typeof   fieldsConfig[field].typeField.emailField !== "boolean"){
                    throw "emailField option should be boolean";
                }else {
                    if (fieldsConfig[field].typeField.emailField){
                        let fieldValue = this.formData.get(fieldsConfig[field].name);
                        _field = new EmailField();
                       // console.log(fieldValue);
                        this.#response[`isValid${field.charAt(0).toUpperCase() + field.slice(1)}`].Email =_field.isValid(fieldValue);
                    }
                }
            }
            if (fieldsConfig[field].typeField.hasOwnProperty("digitsField")){
                if(typeof   fieldsConfig[field].typeField.digitsField !== "boolean"){
                    throw "digitsField option should be boolean";
                }else {
                    if (fieldsConfig[field].typeField.digitsField){
                        let fieldValue = this.formData.get(fieldsConfig[field].name);
                        _field = new DigitsField();
                        this.#response[`isValid${field.charAt(0).toUpperCase() + field.slice(1)}`].Digits =_field.isValid(fieldValue);
                    }
                }
            }
            if (fieldsConfig[field].typeField.hasOwnProperty("passwordField")){
                let fieldValue = this.formData.get(fieldsConfig[field].name);
                const _type = fieldsConfig[field].typeField.passwordField;
                const options={};
                options.uppercase = _type.hasOwnProperty("uppercase") ? _type.uppercase : true;
                options.lowercase = _type.hasOwnProperty("lowercase") ? _type.lowercase : true;
                options.numeric = _type.hasOwnProperty("numeric") ? _type.numeric : true;
                options.special = _type.hasOwnProperty("special") ? _type.special : true;
                options.minLength = _type.hasOwnProperty("minLength") ? _type.minLength : 12;
                _field =  new PasswordField(options);
                _field.isValid(fieldValue);
                this.#response[`isValid${field.charAt(0).toUpperCase() + field.slice(1)}`].Password =_field.isValid(fieldValue);
            }
        }
        return this.#response;
    }
    isValidate(checkFormValidation) {
        console.log(checkFormValidation)
        for (let key in checkFormValidation){
            this.isValidateInput(checkFormValidation);
        }
        return true;
    }
    isValidateInput(checkInputValidation) {
        for (let key in checkInputValidation){
            if (typeof checkInputValidation[key]==='object'){
                if (this.#valueExists(checkInputValidation[key],false)){
                    return false;
                }
            }else {
                if (checkInputValidation[key]===false){
                    return false;
                }
            }
        }
        return true;
    }
    #valueExists(obj, value) {
        for (let key in obj) {
            if (obj[key] === value) {
                return true;
            }
        }
        return false;
    }
    /**
     * Méthode pour récupérer les données du formulaire
     * @returns {{}}
     */
    getDataFormData() {
        const data = {};
        this.formData.forEach((value, key) => {
            data[key] = value;
        });
        return data;
    }
    /**
     * @returns {*}
     */
    getFormData() {
        return this.formData;
    }
     validateFields(fields,fieldsConfig, _addClass, _removeClass) {
        let allValid = true;
        fields.forEach(fieldName => {
            const element = document.getElementById(fieldName);
            // Valider l'élément selon vos critères de validation
            const isValid = this.isValidateInput(this.checkFormValidation(fieldsConfig)[`isValid${capitalizeFirstLetter(fieldName)}`]);
            if (!isValid) {
                allValid = false;
                addClass(fieldName, _addClass);
            } else {
                removeClass(fieldName,_addClass)
                addClass(fieldName, _removeClass);
            }
        });
        return allValid;
    }
    append(nameInput,value){
        this.formData.append(nameInput,value);
    }
    resetFields(){
        return this.#formElement.reset();
    }
    // Méthode pour soumettre le formulaire
    /**
     * @param {{url}}url
     * @param {{bool}}valide
     * @returns {Promise<any>}
     */
    async submitForm(url,valide=true) {
        if (valide) {
            try {
                const data = this.getDataFormData();
                formData.forEach((value, key) => {
                    //   console.log( data[key] = value;)
                });
                //console.log(data);
                const csrfToken = this.#formElement.getAttribute('data-csrf-token');
                const response = await fetchData({
                    url: url,
                    method: 'POST',
                    headers: {
                        Accept: 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body:  JSON.stringify(data),
                    responseType: 'json'
                });
                console.log('Success:', response);
                return response;
            } catch (error) {
                console.error(error.cause)
            }
        }else {
            throw new Error('form validation error');
        }
    }
}
