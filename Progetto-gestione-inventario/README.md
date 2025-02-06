# Pixel Market Project 🚀

Welcome to the **Pixel Market Project**! This project is designed to validate multiple form inputs, ensuring that the data entered by the user is correct and meets the required standards. It includes a variety of checks for fields like **Credit Card Number**, **CVV**, **Expiration Date**, **Email**, **CAP**, **Name**, **Password**, and more.

## Table of Contents 📑

- [Project Overview](#project-overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Setup Instructions](#setup-instructions)
- [How to Use](#how-to-use)
- [Form Validation Rules](#form-validation-rules)
- [Contributing](#contributing)
- [License](#license)

## Project Overview 🌟

The **Pixel Market Project** provides a robust validation system for various types of form inputs. It is built with **JavaScript** and is designed to check for common user input errors such as empty fields, incorrect formats, and invalid data.

The project aims to improve user experience by offering clear feedback when the data entered into a form is invalid. The validation includes checks for:
- **Credit Card Number** (validity and Luhn algorithm)
- **CVV** (3 digits)
- **Expiration Date** (must be in the future)
- **Email Address** (valid format)
- **CAP** (5-digit postal code)
- **Name** (only letters)
- **Password** (at least 8 characters)
- **Address** (cannot be empty)

## Features 🎉

- **Real-time Input Validation**: The form is validated as soon as the user submits it.
- **Detailed Error Messages**: Clear and concise error messages inform the user about the invalid fields.
- **Credit Card Validation**: Implements the Luhn algorithm to validate the credit card number.
- **Password and Confirm Password Match**: Ensures the password and confirm password fields match.
- **Email, Name, and CAP Validation**: Validates email format, name (only letters), and postal code (5 digits).
- **Expiration Date Check**: Ensures the credit card expiration date is not in the past.

## Technologies Used ⚙️

- **HTML**: Structure of the form.
- **CSS**: Basic styling for the form.
- **JavaScript**: Core functionality for form validation.
- **PHP** 🧑‍💻: Used for server-side validation and form handling.

## How to Use 📝

1. **Fill in the form**: Enter your details into the form fields, including the username, password, email, credit card information, and address.
2. **Submit the form**: Once you have filled out the form, click the submit button.
3. **View the results**: If any field is invalid, an alert will pop up with a description of the errors.
4. **Correct the errors**: Modify the fields as per the instructions and submit the form again.

## Form Validation Rules 🛡️

The following fields are validated:

### 1. **Credit Card Number** 💳
- Must contain exactly **16 digits**.
- The card number is validated using the **Luhn algorithm** to ensure it's a valid card number.

### 2. **CVV** 🔒
- Must contain exactly **3 digits**.
- The CVV field is checked to make sure it’s in the correct format.

### 3. **Expiration Date** 📅
- Must be a **future date**.
- The expiration date is validated to ensure it hasn’t passed.

### 4. **Email** 📧
- Must match a standard **email format** (e.g., example@example.com).
- The email field is validated using a regular expression.

### 5. **CAP** 📍
- Must contain exactly **5 digits**.
- The postal code (CAP) is validated to ensure it’s in the correct format.

### 6. **Name & Surname** 🧑‍🤝‍🧑
- Must contain **only letters** (including accented characters) and spaces.
- The name and surname fields are validated using a regular expression that checks for valid characters.

### 7. **Password** 🔑
- Must be **at least 8 characters** long.
- The password must meet the minimum length requirement.

### 8. **Confirm Password** 🔐
- The confirm password field must match the password field exactly.

### 9. **Address** 🏠
- Cannot be **empty**.
- The address field must be filled in.

## License 📄

This project is open-source and available under the [MIT License](LICENSE).

---

Thank you for checking out the **Pixel Market Project**! We hope it helps you with validating forms on your web applications. If you encounter any issues or have questions, feel free to reach out. 😊
```