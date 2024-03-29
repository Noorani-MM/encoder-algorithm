# CryptoHandler 🔏

This package provides a simple encryption and decryption functionality for securing sensitive information in your PHP applications. 
It offers easy-to-use methods for encrypting plaintext data into ciphertext and decrypting ciphertext back into its original plaintext form.

## Features 🔧
- Ease of Use: Simple and straightforward API for encryption and decryption operations.
- Well-Documented: Comprehensive documentation and usage examples to help you get started quickly.

## How to install 

```bash
composer require noorani-mm/encoder-algorithm
```

## How to use ⚒️

### Encrypting Content

To encrypt content, use the `Encrypt` method:
```php
$content = "Your content here";
$encrypted_content = CryptoHandler::Encrypt($content);
echo $encrypted_content; // a6908a8ddf9c90918b9a918bdf979a8d9a
```

### Decrypting Content

To decrypt content, use the `Decrypt` method:
```php
$hex = "a6908a8ddf9c90918b9a918bdf979a8d9a";
$decrypted_content = CryptoHandler::Decrypt($hex);
echo $decrypted_content; // Your content here
```