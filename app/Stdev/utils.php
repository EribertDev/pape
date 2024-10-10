<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Génère une chaîne aléatoire composée de lettres et de chiffres.
 *
 * @param int $length Longueur de la chaîne générée.
 * @param string $type Type de caractères ('digits', 'letters', 'mixed').
 * @return string Chaîne aléatoire générée.
 * @throws Exception
 */
if (!function_exists('generateRandomString')) {
    function generateRandomString(int $length, string $type): string
    {
        switch ($type) {
            case 'digits':
                return Str::random($length, '0123456789');
            case 'letters':
                return Str::random($length, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            case 'mixed':
            default:
                return Str::random($length);
        }
    }
}

/**
 * Génère une référence unique avec un préfixe donné.
 *
 * @param string $prefix Préfixe de la référence (par défaut 'AL_').
 * @param int $length Longueur totale de la référence (par défaut 10).
 * @param string $table Nom de la table où vérifier l'unicité de la référence.
 * @param string $column Nom de la colonne à vérifier pour l'unicité.
 * @param bool $toupper Convertir la référence en majuscules (par défaut true).
 * @param string $type Type de caractères pour la chaîne générée (par défaut 'mixed').
 * @return string Référence unique générée.
 * @throws Exception
 */
if (!function_exists('generateUniqueReference')) {
    function generateUniqueReference(
        string $prefix = 'AL_',
        int $length = 10,
        string $table = 'your_table',
        string $column = 'reference',
        bool $toupper = true,
        string $type = 'mixed'
    ): string {
        do {
            $reference = $prefix . generateRandomString($length - strlen($prefix), $type);
            $reference = $toupper ? strtoupper($reference) : $reference;
            $exists = DB::table($table)->where($column, $reference)->exists();
        } while ($exists);

        return $reference;
    }
}

if (!function_exists('get_string_initial')) {
    /**
     * @throws Exception
     */
    function get_string_initial(string $text,int $size): string
    {
        // Division le nom en mots
        $mots = explode(' ', $text);
        // Extraire la première lettre de chaque mot
        $initials = array_map(function ($mot) {
            return $mot[0];
        }, $mots);
        // echo implode($initials);
        return implode($initials);

    }


}
