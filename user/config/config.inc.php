<?php
    define("VISA_DEVELOPMENT", true);

    // Desarrollo Visa
    define('DEV_IZIPAY_CLIENT_ID', '89289758');
    define('DEV_IZIPAY_URL', 'https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment');
    define('DEV_IZIPAY_CLIENT_SECRET', 'testpassword_7vAtvN49E8Ad6e6ihMqIOvOHC6QV5YKmIXgxisMm0V7Eq');
    define('DEV_IZIPAY_PUBLIC_KEY', '89289758:testpublickey_TxzPjl9xKlhM0a6tfSVNilcLTOUZ0ndsTogGTByPUATcE');
    define('DEV_IZIPAY_HAS_KEY', 'fva7JZ2vSY7MhRuOPamu6U5HlpabAoEf8VmFHQupspnXB');

    // Producción Visa
    define('PROD_IZIPAY_CLIENT_ID', '58211388');
    define('PROD_IZIPAY_URL', 'https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment');
    define('PROD_IZIPAY_CLIENT_SECRET', 'testpassword_5XaqW3unjbzaQtvQrpixbtljiUr4RtZaFGNLYaLRccCOy');
    define('PROD_IZIPAY_PUBLIC_KEY', 'testpublickey_Qdqqh8L8nlaUXvHujFFKmEuC5SmZds067TppVmpJpWOac');
    define('PROD_IZIPAY_HAS_KEY', 'YElnxd60beFxQ0qRRt4hwvwhdArFwEyyzmc9hGgE3E9QU');

    // Configuración visa
    define('IZIPAY_CLIENT_ID', VISA_DEVELOPMENT ? DEV_IZIPAY_CLIENT_ID : PROD_IZIPAY_CLIENT_ID);
    define('IZIPAY_URL', VISA_DEVELOPMENT ? DEV_IZIPAY_URL : PROD_IZIPAY_URL);
    define('IZIPAY_CLIENT_SECRET', VISA_DEVELOPMENT ? DEV_IZIPAY_CLIENT_SECRET : PROD_IZIPAY_CLIENT_SECRET);
    define('IZIPAY_PUBLIC_KEY', VISA_DEVELOPMENT ? DEV_IZIPAY_PUBLIC_KEY : PROD_IZIPAY_PUBLIC_KEY);
    define('IZIPAY_HAS_KEY', VISA_DEVELOPMENT ? DEV_IZIPAY_HAS_KEY : PROD_IZIPAY_HAS_KEY);