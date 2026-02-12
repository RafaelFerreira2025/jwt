<?php
// Codifica dados para Base64URL
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

// Decodifica dados de Base64URL
function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

// Exemplo de uso
$original = "Hello World!/+/+";
$encoded = base64url_encode($original);
$decoded = base64url_decode($encoded);

echo "Original: " . $original . "\n";
echo "Base64URL: " . $encoded . "\n"; // SgQ7SGVsbG8gV29ybGQhLysvKw
echo "Decodificado: " . $decoded . "\n";
?>
