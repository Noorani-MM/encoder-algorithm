# Encoder 🔏
In this package, English text is encrypted and decoded.

## How to install 

```bash
composer require noorani-mm/encoder-algorithm
```

## How to use 

To encrypt text you have to use `encode` function this function will return encoded context

```php
$content = 'Hello this is the content';

$encoded = \NooraniMm\EncoderAlgorithm\Coder::encode($content); // GF0944O_sfvܠ|{bpm铉czܠ|{blܠ|jiunlh{0019CCBA
```

To decrypt, encoded content you have to use `decode` function. This function will return decoded content. 
- On invalid parameter this function throw `InvalidEncodedException`

```php
$decoded = \NooraniMm\EncoderAlgorithm\Coder::decode($encoded); // Hello this is the content
```