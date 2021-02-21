<script>
public static function search_cep(string $cep)
{
    try {
        $results = simplexml_load_file("https://viacep.com.br/ws/$cep/xml/");
        $results = (array) $results;
        $results['municipio'] = $results['localidade'];
        unset($results['localidade']);
        return $results;
    } catch (\Exception $e) {
        return false;
    }
}
</script>

