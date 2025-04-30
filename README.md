## 🚀 Cómo usarlo en XAMPP

1. **Ubicación de archivos:**  
   Copia el proyecto dentro del directorio `htdocs` de tu instalación de XAMPP. Por ejemplo:
C:\xampp\htdocs\calculadora-seguro


2. **Inicia XAMPP:**  
- Abre el **Panel de Control de XAMPP**
- Inicia el módulo **Apache** y **Mysql**

3. **Accede desde el navegador:**  
Abre tu navegador y ve a:
http://localhost/calculadora-seguro/

3.1 **Para acceder a la base de datos**
http://localhost/phpmyadmin/
http://localhost/phpmyadmin/index.php?route=/database/structure&db=calculadora_seguro2


## 🧭 Flujo del formulario

1. `index.php`: Inicio del formulario (selección de fecha de inicio).
2. `step2.php`: Selección código postal.
2. `step3.php`: Selección del número de asegurados.
3. `step4.php`: Introducción de los datos de cada asegurado (fecha de nacimiento, sexo, parentesco).
4. `step5.php`: Elección cobertura dental.
5. `step6.php`: Elección si ya es cliente o no.
6. `step7.php`: Formulario final.
7. `resultados.php`: Información pólizas.

Los datos se almacenan entre pasos mediante `$_SESSION`.

## ✅ Validaciones

- Cada paso valida que los datos anteriores existan antes de continuar.
- En `step4.php`, se puede validar que las fechas de nacimiento tengan sentido (por ejemplo, no futuras y edades realistas).



## 🎨 Características visuales

- Barra de progreso por paso.
- Botones de selección que se resaltan al hacer clic.
- Diseño responsive con CSS.
- Modal informativo con JavaScript.



## 🧩 Personalización

- **Estilo visual**: Modifica `assets/css/style.css`.
- **Interacción**: Ajusta `assets/js/script.js`.
- **Lógica PHP**: Cada `stepX.php` se puede adaptar a tus necesidades de negocio.



👨‍💻 Desarrollado en PHP para XAMPP por Camila – 2025
