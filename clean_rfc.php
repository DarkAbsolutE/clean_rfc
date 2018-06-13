<?php 
	/**
	 * Formateo especial para los RFC, este mismo puede ser usado para datos como la CURP, INE, etc.
	 * Toda cadena que requiera ser unicamente alfanumerica, mayusculas y sin ningun espacio.
	 * 
	 * @param  String $str Cadena de texto a formatear.
	 * @return String      Dato formateado.
	 */
	function cleanRFC($str) {
		$rfc_clean_process = $this->cleanSpacesUpper($str);
		$rfc_clean_process = $this->elimina_acentos($rfc_clean_process);
		$rfc_clean         = $this->cleanAlphanumeric($rfc_clean_process);
		
		return $rfc_clean;
	}

	/**
	 * Se eliminan todos los espacios de una cadena de texto y despues se convierten en mayusculas todas las letras, esto es requerido para datos oficiales de identificación como lo es la CURP, RFC, INE, etc.
	 * 
	 * @param  String $str Candena de texto a limpiar.
	 * @return String      Cadena lista para ser usada.
	 */
	function cleanSpacesUpper($str) {
		$strSlug  = str_slug($str, '');
		$strUpper = strtoupper($strSlug);

		return $strUpper;
	}

	/**
	 * Se reemplazan los caracteres con acentos, tildes, etc.
	 * @param  String $text Texto a reemplazar.
	 * @return String       Texto reemplazado.
	 */
	function elimina_acentos($text)
    {
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',

            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',

            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',

            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',

            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',

            // Agregar aqui mas caracteres si es necesario

        );

        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }

    /**
	 * Se limpia una cadena de texto dejando puros datos alfanumericos, esto se usa mas que nada para información que requiere solo contener numeros y letras evitando cualquier caracter especial, signuo, etc.
	 * 
	 * @param  String $str Cadena a limpiar.
	 * @return String      Cadena alfanumerica lista para ser usada.
	 */
	function cleanAlphanumeric($str) {
		$clean = preg_replace("/[^a-zA-Z0-9]/", '', $str);
		$clean = trim($clean);

		return $clean;
	}
 ?>