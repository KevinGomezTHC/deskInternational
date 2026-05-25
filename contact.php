<?php
// Obtener el email del formulario
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Por favor ingresa un email válido']);
    exit;
}

// Email del cliente
$client_email = $email;
$client_subject = "¡Gracias por tu interés en Desk International!";
$client_message = "Hola,\n\n";
$client_message .= "¡Gracias por tu interés en nuestros servicios!\n\n";
$client_message .= "Hemos recibido tu correo y nos estaremos contactando pronto para ofrecerte la mejor solución para tu empresa.\n\n";
$client_message .= "Nuestro equipo te llamará en los próximos 2-3 días hábiles para:\n";
$client_message .= "- Entender tus necesidades específicas\n";
$client_message .= "- Brindarte una consulta personalizada\n";
$client_message .= "- Mostrar cómo Desk International puede ayudarte a crecer\n\n";
$client_message .= "Servicios que ofrecemos:\n";
$client_message .= "✓ Call Center\n";
$client_message .= "✓ Facturación\n";
$client_message .= "✓ Cuentas por Cobrar\n";
$client_message .= "✓ Planillas\n";
$client_message .= "✓ Afiliaciones Caja e INS\n\n";
$client_message .= "Por solo \$700 al mes\n\n";
$client_message .= "¿Preguntas? Contáctanos:\n";
$client_message .= "📱 WhatsApp: +506 XXXX-XXXX\n";
$client_message .= "📧 Email: info@deskinternational.com\n\n";
$client_message .= "¡Esperamos trabajar contigo!\n\n";
$client_message .= "Saludos,\n";
$client_message .= "Equipo Desk International";

// Headers del email
$headers = "From: info@deskinternational.com\r\n";
$headers .= "Reply-To: info@deskinternational.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Intentar enviar email al cliente
$client_sent = mail($client_email, $client_subject, $client_message, $headers);

// Email al administrador (opcional - para tu registro)
$admin_email = "admin@deskinternational.com"; // Cambiar por tu email
$admin_subject = "Nuevo lead: " . $email;
$admin_message = "Se ha registrado un nuevo interesado:\n\n";
$admin_message .= "Email: " . $email . "\n";
$admin_message .= "Fecha: " . date('Y-m-d H:i:s') . "\n";

$admin_sent = mail($admin_email, $admin_subject, $admin_message, $headers);

// Responder con JSON
header('Content-Type: application/json');
if ($client_sent) {
    echo json_encode([
        'success' => true, 
        'message' => '¡Gracias! Hemos recibido tu email. Revisa tu bandeja de entrada para más detalles.'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Hubo un error. Por favor intenta nuevamente.'
    ]);
}
?>
