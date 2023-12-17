<?php
date_default_timezone_set('Asia/Jakarta');

// Buat RSA Key 1024 bit atau 2048 bit di Linux/FreeBSD 
// $ openssl genrsa 1024
// $ openssl genrsa 2048
$key = "AAAAB3NzaC1yc2EAAAADAQABAAABAQCQqeDV83KcOEFk+yHQ7BMhnBmqUzdAXGdKdOu19acIusb7M90rGh3PwZVTII2HxVfr2CysOMQAFzDtnsCPgpdy/1u6ctwG1aFf8Kz9lKrVJqoiucVtFN46YAvWZtDWZv98BqauiAKoaeesRW2oK52yywjrxl0qb1WFRa7srwh/rea7xiQxXsBUfk6DFgcXZ4RNQAeMmi3bh8LdRHekZVSD+pwX4CVbzsZJvDnfwqmNt7XWBDCDmohqPSrJ2HBVdj8VBS4WvtzgxiPYHffj2mIBQYgGCdPfRAdks8VHdR+vDVLSGSQEdIAul+y0CPH4d77UQIUTzbiWwciNLtt3kI2f";
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid selama 1 jam
$issuer = "RestApiAuthJWT";
?>