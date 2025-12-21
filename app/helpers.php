<?php

use App\Models\Setting;
use App\Models\SmsMessageQueue;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;
use Illuminate\Translation\Translator;
use Carbon\Carbon;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Container\Container;
use App\Libraries\Database\Eloquent\Model;
use App\Repositories\AgencyRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Cjmellor\Approval\Enums\ApprovalStatus;
use App\Repositories\UserRepository;
use Spatie\Permission\Contracts\Permission;

if (!function_exists('user')) {
    /**
     * Get current logged in user based on the guard.
     *
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user()
    {
        return auth('api')->user() ?? auth('users')->user();
    }
}

if (!function_exists('customer')) {
    /**
     * Get current logged in customer.
     *
     * @return \App\Models\Customer|\Illuminate\Contracts\Auth\Authenticatable
     */
    function customer()
    {
        return auth('api')->user() ?? auth('customers')->user();
    }
}

if (!function_exists('__t')) {
    /**
     * A different approach to the `trans` method.
     *
     * @param string $key
     * @param string $fallback
     * @param array  $replace
     *
     * @return mixed
     */
    function __t($key, $fallback, $replace = [])
    {
        /** @var Translator $translator */
        $translator = trans();

        if ($translator->has($key, null)) {
            return $translator->get($key, $replace);
        }

        return $translator->get($fallback, $replace);
    }
}

if (!function_exists('modelAction')) {
    /**
     * Get some model action by type.
     *
     * @param string      $type
     * @param string      $action
     * @param string|null $fallback
     *
     * @return string
     */
    function modelAction($type, $action, $fallback = null)
    {
        return __t(
            "models.$type.actions.$action",
            $fallback
                ? "models.$type.actions.$fallback"
                : "models.default.actions.$action"
        );
    }
}

if (!function_exists('modelName')) {
    /**
     * Get some model attribute by type.
     *
     * @param string $type
     *
     * @return string
     */
    function modelName($type)
    {
        if (empty(__t('models.' . $type . '.name', ''))) {
            return
                __t(
                    'models.' . $type . '.actions.label',
                    class_basename($type)
                );
        }

        return __t('models.' . $type . '.name', '');
    }
}

if (!function_exists('isApp')) {
    /**
     * check if it's an app.
     *
     * @param string $type
     *
     * @return string
     */
    function isApp()
    {
        return request()->header('inv-source') === 'app';
    }
}

if (!function_exists('translateApprovalStatus')) {
    // Em algum arquivo de helpers ou diretamente no modelo
    function translateApprovalStatus($status)
    {
        return match ($status) {
            ApprovalStatus::Pending => __('Pendente'),
            ApprovalStatus::Approved => __('Aprovado'),
            ApprovalStatus::Rejected => __('Rejeitado'),
            default => __('Desconhecido')
        };
    }
}

if (!function_exists('modelAttribute')) {
    /**
     * Retorna o label de um atributo de modelo.
     *
     * @param string|object $type Nome do modelo ou instância
     * @param string $field Campo do modelo
     * @param string|null $fallback Campo fallback
     * @return string
     */
    function modelAttribute($type, $field, $fallback = null)
    {
        // Se passar uma instância, pega só o nome do modelo
        if (is_object($type)) {
            $type = class_basename($type);
        }

        // Normaliza para string
        $type = (string) $type;

        // Tenta localizar a tradução
        $translationKey = "models.$type.attributes.$field";
        $fallbackKey = $fallback ? "models.$type.attributes.$fallback" : "models.default.attributes.$field";

        return __($translationKey, [], null) !== $translationKey
            ? __($translationKey)
            : __($fallbackKey);
    }
}


if (!function_exists('multipleModelValues')) {
    /**
     * Get some model attribute by type.
     *
     * @param string      $type
     * @param string      $field
     * @param string|null $fallback
     *
     * @return string
     */
    function multipleModelValues($currentObject, $slices, $column)
    {
        $values = [];

        // Percorre e armazena as descrições das assinaturas em um array
        foreach ($currentObject as $object) {
            $newObject = $object;

            foreach ($slices as $index => $slice) {
                $camelSlice = Str::camel($slice);

                if ($newObject) {
                    if (method_exists($newObject, $camelSlice)) {
                        $newObject = $newObject->$camelSlice;
                    } elseif (method_exists($newObject, $slice)) {
                        $newObject = $newObject->$slice;
                    }
                }
                if (get_class($newObject) == 'Illuminate\Database\Eloquent\Collection') {
                    $values[] = multipleModelValues($newObject, array_slice($slices, $index + 1), $column);
                }
            }

            if ($newObject) {
                $values[] = $newObject->$column;
            }
        }

        // Use implode para unir as descrições em uma única string
        return $values;
    }
}


if (!function_exists('globals')) {
    /**
     * Alias to the registry function.
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function globals($key = null, $default = null)
    {
        return registry($key, $default);
    }
}

if (!function_exists('isEmpty')) {
    /**
     * Alias to the registry function.
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function isEmpty($arrayObject)
    {
        return count($arrayObject) === 0;
    }
}



if (!function_exists('registry')) {
    /**
     * Handles global variables in a controlled namespace.
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function registry($key = null, $default = null)
    {
        if (is_string($key)) {
            $key = 'registry.' . $key;
        } elseif (is_array($key)) {
            foreach ($key as $index => $value) {
                $key['registry.' . $index] = $value;
                unset($key[$index]);
            }
        } elseif (is_null($key)) {
            $key = 'registry';
        }

        return config($key, $default);
    }
}

if (!function_exists('title')) {
    /**
     * Builds page name.
     *
     * @param string $page
     * @param bool   $reverse
     * @param string $divider
     *
     * @return string
     */
    function title($page, $reverse = true, $divider = '|')
    {
        $page = [$page];

        if ($reverse) {
            array_push($page, config('app.name'));
        } else {
            array_unshift($page, config('app.name'));
        }

        return implode(' ' . $divider . ' ', $page);
    }
}


if (!function_exists('sameRoutePrefix')) {
    /**
     * Check if route has the same prefix as current route.
     *
     * @param string $route
     *
     * @return bool
     */
    function sameRoutePrefix($route)
    {
        if ($route) {
            $currentRoute = request()
                ->route()
                ->getName();

            $prefix = explode('.', $route);
            unset($prefix[count($prefix) - 1]);
            $prefix = implode('.', $prefix);

            return substr($currentRoute, 0, strlen($prefix)) == $prefix;
        }

        return false;
    }
}


if (!function_exists('phoneFormat')) {
    /**
     * Converts a string to phone format.
     *
     * @param $value
     *
     * @return string
     */
    function phoneFormat($value)
    {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
    }
}

if (!function_exists('documentFormat')) {
    /**
     * Converts a string to document format.
     *
     * @param $value
     *
     * @return string
     */
    function documentFormat($value)
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
    }
}

if (!function_exists('cnpjFormat')) {
    /**
     * Converts a string to document format.
     *
     * @param $value
     *
     * @return string
     */
    function cnpjFormat($value)
    {
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $value);
    }
}

if (!function_exists('transformHexToRgba')) {
    /**
     * Converts a hex to rgba color.
     *
     * @param $value
     *
     * @return string
     */
    function transformHexToRgba($value)
    {

        $split = str_split(str_replace('#', '', $value), 2);
        if (is_array($split) && isset($split[1])) {
            $r = hexdec($split[0]);
            $g = hexdec($split[1]);
            $b = hexdec($split[2]);
            return $r . ',' . $g . ',' . $b;
        }

        // return string
        return $value;
    }
}

if (!function_exists('buildStatusBadge')) {
    /**
     * Converts a hex to rgba color by status.
     *
     * @param $value
     *
     * @return string
     */
    function buildStatusBadge($name, $color)
    {
        return '<span class="badge p-2" style="color:' . $color . '; background-color: rgba(' . transformHexToRgba($color) . ', 0.1);">' . $name . '</span>';
    }
}

if (!function_exists('buildStatusBadgeBlade')) {
    /**
     * Converts a hex to rgba color by status.
     *
     * @param $value
     *
     * @return string
     */
    function buildStatusBadgeBlade($name, $color, $title = null)
    {
        echo '<span class="badge mr-3" title="' . $title . '" style="color:' . $color . '; background-color: rgba(' . transformHexToRgba($color) . ', 0.1);">' . $name . '</span>';
    }
}

if (!function_exists('buildStatusMainBadge')) {
    /**
     * Converts a hex to rgba color by status.
     *
     * @param $value
     *
     * @return string
     */
    function buildStatusMainBadge($name, $color, $title = null)
    {
        return '<span class="badge mr-3 text-white" id="main-status" title="' . $title . '" style="background-color: ' . $color . ';">' . $name . '</span>';
    }
}

if (!function_exists('buildStatusMainBadgeBlade')) {
    /**
     * Converts a hex to rgba color by status.
     *
     * @param $value
     *
     * @return string
     */
    function buildStatusMainBadgeBlade($name, $color, $title = null)
    {
        echo '<span class="badge mr-3 text-white" id="main-status" title="' . $title . '" style="background-color: ' . $color . ';">' . $name . '</span>';
    }
}

if (!function_exists('lockTable')) {
    function lockTable($table, $mode = 'SHARE ROW EXCLUSIVE')
    {
        $connection = DB::connection()
            ->getName();

        if ($connection == 'mysql') {
            $sql = "LOCK TABLES {$table} WRITE";
        }

        if ($connection == 'mssql') {
            $sql = "LOCK TABLE {$table}";
        }

        if ($connection == 'pgsql') {
            $sql = "LOCK TABLE {$table} IN {$mode} MODE";
        }

        try {
            DB::unprepared($sql);
        } catch (Exception $e) {
            //do something
            dd($e);
        }
    }
}

if (!function_exists('hex2rgba')) {
    function hex2rgba($colour, $alpha = 1)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = [$colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]];
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = [$colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]];
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return "rgba($r, $g, $b, $alpha)";
    }
}

if (!function_exists('capitalize')) {
    /**
     * Return a capitalized string.
     */
    function capitalize(string $name)
    {
        $name = explode(' ', mb_strtolower($name));

        foreach ($name as $key => $word) {
            if (!in_array($word, ['de', 'do', 'dos', 'da', 'das', 'e'])) {
                $name[$key] = mb_convert_case($word, MB_CASE_TITLE, 'UTF-8');
            }
        }

        return implode(' ', $name);
    }
}

if (!function_exists('insertVariables')) {
    /**
     * Insert specific variables on texts descriptions.
     *
     * @param array $values
     * @param $text
     *
     * @return string|string[]|null
     */
    function insertVariables($values, $text)
    {
        // if(is_string($values)) {
        //     $values = json_decode($values);
        // }

        preg_match_all('/\{(.[^\s]*?)\}/', $text, $matches);
        $variables = $matches[1];

        $result = $text;

        foreach ($variables as $var_name) {
            $result = str_replace('{' . $var_name . '}', '{' . Str::lower($var_name) . '}', $result);
        }

        if ($values) {
            foreach ($values as $k => $v) {
                $result = str_replace('{' . Str::lower($k) . '}', $v ?? '', $result);
            }
        }

        return $result;
    }
}

if (!function_exists('canSection')) {
    /**
     * Verifiy if an user can view a section.
     *
     * @return bool
     */
    function canAdminSection(array $section)
    {
        if (!empty(data_get($section, 'items.*.policy'))) {
            foreach (data_get($section, 'items.*.policy') as $policy) {
                if (!empty($policy)) {
                    if ($policy && user()->can(...$policy)) {
                        return true;
                    }
                }
            }
        }


        return false;
    }
}


if (!function_exists('getTokenFromHeaderRequest')) {
    /*
     * Check if has a token on header
     *
     * @return null|string
     */
    function getTokenFromHeaderRequest()
    {
        return request()->bearerToken();
    }
}

if (!function_exists('clamp')) {
    /*
     * Clamp number between min and max
     */
    function clamp($number, $min, $max)
    {
        // this '+ 0' is a generic number converter :D
        return min(max($min, $number), $max) + 0;
    }
}

if (!function_exists('getSearchQuery')) {
    /**
     * Get the current request attribute q.
     *
     * @param bool $asString
     *
     * @return mixed
     */
    function getSearchQuery($asString = true)
    {
        $query = request('q');
        if (!$asString) {
            return $query;
        }
        if (!is_string($query) && is_array($query)) {
            $query = implode(' ', \Illuminate\Support\Arr::flatten($query));
        } else {
            $query = strval($query);
        }

        return $query;
    }
}


if (!function_exists('remove_emoticons')) {
    /**
     * Check feature status.
     *
     * @param string $text
     *
     * @return string
     */
    function remove_emoticons($text)
    {
        $cleanText = '';

        // Match Emoticons
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $cleanText = preg_replace($regexEmoticons, '', $text);

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $cleanText = preg_replace($regexSymbols, '', $cleanText);

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        $cleanText = preg_replace($regexTransport, '', $cleanText);

        // Match Miscellaneous Symbols
        $regexMisc = '/[\x{2600}-\x{26FF}]/u';
        $cleanText = preg_replace($regexMisc, '', $cleanText);

        // Match Dingbats
        $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
        $cleanText = preg_replace($regexDingbats, '', $cleanText);

        return $cleanText;
    }
}

function getIcon($name, $class = '', $type = '')
{
    $type = config('settings.KT_THEME_ICONS', 'duotone');
    $tag = 'span';
    if ($type === 'duotone') {
        $icons = cache()->remember('duotone-icons', 3600, function () {
            return json_decode(file_get_contents(public_path('icons.json')), true);
        });
        $pathsNumber = data_get($icons, 'duotone-paths.' . $name, 0);
        $output = '<' . $tag . ' class="ki-' . $type . ' ki-' . $name . (!empty($class) ? " " . $class : '') . '">';
        for ($i = 0; $i < $pathsNumber; $i++) {
            $output .= '<' . $tag . ' class="path' . ($i + 1) . '"></' . $tag . '>';
        }
        $output .= '</' . $tag . '>';
    } else {
        $output = '<' . $tag . ' class="ki-' . $type . ' ki-' . $name . (!empty($class) ? " " . $class : '') . '"></' . $tag . '>';
    }
    return $output;
}

if (!function_exists('remove_crap')) {
    /**
     * Remove crap of string
     *
     * @param string $string
     *
     * @return string
     */
    function remove_crap($string)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}

if (!function_exists('is_empty')) {
    /**
     * Verify is empty
     *
     * @param mixed[] ...$args List of arguments that will be checked with "empty()"
     *
     * @return boolean Returns true if at least one of the arguments for empty
     */
    function is_empty(...$args)
    {
        foreach ($args as $arg) {
            if (empty($arg)) return true;
        }

        return false;
    }
}

if (!function_exists('settings')) {
    /**
     * Handles global variables in a controlled namespace.
     *
     * @param string|array $key
     * @param mixed|null   $default
     *
     * @return mixed
     */
    function settings($key, $default = null)
    {
        // Load stored configuration
        $loadArray = [];

        if (is_string($key)) {
            $loadArray[] = $key;
        } elseif (is_array($key)) {
            $loadArray = array_keys($key);
        }

        foreach ($loadArray as $load) {
            $partials = explode('.', $load);
            $initial = data_get($partials, 0);

            if (!config()->has('settings.' . $initial)) {
                $setting = Setting::where('meta_key', $initial)
                    ->first();

                config(['settings.' . $initial => $setting ? $setting->meta_value : null]);
                config(['settings.__old.' . $initial => $setting ? $setting->meta_value : null]);
            }
        }

        // Do what it has to do
        if (is_array($key)) {
            // Organize data for storage
            foreach ($key as $index => $value) {
                $key['settings.' . $index] = $value;
                unset($key[$index]);
            }
        } elseif (is_string($key)) {
            // Prepare data for fetch
            $key = 'settings.' . $key;
        }

        return config($key, $default);
    }
}

if (!function_exists('settingsRaw')) {
    /**
     * Get raw setting from database.
     *
     * @param string $key
     *
     * @return Setting
     *
     * @throws Exception
     */
    function settingsRaw($key)
    {
        return cache()->remember('settings.' . $key, 0, function () use ($key) {
            return Setting::where('meta_key', $key)
                ->first();
        });
    }
}

if (!function_exists('feature_active')) {
    /**
     * Check feature status.
     *
     * @param string $slug
     *
     * @return bool|null
     */
    function feature_active($slug)
    {
        return \App\Facades\FeatureTag::getFeatureStatus($slug);
    }
}

if (!function_exists('contract_setting_active')) {
    /**
     * Check feature status.
     *
     * @param string $slug
     *
     * @return bool|null
     */
    function contract_setting_active($slug)
    {
        return \App\Facades\ContractSettingTag::getContractSettingTags($slug);
    }
}

if (!function_exists('robot_setting_active')) {
    /**
     * Check robot status.
     *
     * @param string $slug
     *
     * @return bool|null
     */
    function robot_setting_active($slug)
    {
        return \App\Facades\RobotSettingTag::getRobotStatus($slug);
    }
}

if (!function_exists('formatarData')) {
    function formatarData($dataOriginal)
    {
        // Converta a string para um objeto Carbon
        $dataCarbon = Carbon::parse($dataOriginal);

        // Formate a data no novo formato desejado
        return $dataCarbon->format('d/m/Y H:i:s');
    }
}

if (!function_exists('checksIsRouteApi')) {
    function checksIsRouteApi($route)
    {   // Verifica se a palavra api está presente na string e se está separada por pontos
        if (strpos($route, 'api') !== false) {
            return true; // A palavra está presente na string
        } else {
            return false; // A palavra não está presente na string
        }
    }
}

if (!function_exists('split_name')) {
    function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
        return array($first_name, $last_name);
    }
}


if (!function_exists('removeCrapAcentuation')) {
    function removeCrapAcentuation($string)
    {
        // $string = utf8_decode(trim($string));
        $string = mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string));
        // $string = strtr($string, utf8_decode("ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöùúûüýÿ"), "AAAAAAACEEEEIIIIDNOOOOOUUUUYBaaaaaaaceeeeiiiionooooouuuuyy");
        $string = strtr($string, mb_convert_encoding("ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöùúûüýÿ", "UTF-8", mb_detect_encoding("ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöùúûüýÿ")), "AAAAAAACEEEEIIIIDNOOOOOUUUUYBaaaaaaaceeeeiiiionooooouuuuyy");
        $string = strtr($string, "\xE1\xE8\xEF\xEC\xE9\xED\xF2", "\x61\x63\x64\x65\x65\x69\x6E");
        $string = strtr($string, "\xF3\xF8\x9A\x9D\xF9\xFA\xFD\x9E\xF4\xBC\xBE", "\x6F\x72\x73\x74\x75\x75\x79\x7A\x6F\x4C\x6C");
        $string = strtr($string, "\xC1\xC8\xCF\xCC\xC9\xCD\xC2\xD3\xD8", "\x41\x43\x44\x45\x45\x49\x4E\x4F\x52");
        $string = strtr($string, "\x8A\x8D\xDA\xDD\x8E\xD2\xD9\xEF\xCF", "\x53\x54\x55\x59\x5A\x4E\x55\x64\x44");
        return $string;
    }
}

if (!function_exists('sistema')) {
    function sistema()
    {
        return (new UserRepository)->findByUserSystem();
    }
}

if (!function_exists('agencia')) {
    function agencia()
    {
        return (new AgencyRepository)->findDefaultAgency();
    }
}

if (!function_exists('id_sistema_externo')) {
    function id_sistema_externo()
    {
        return 18; // Sistema Kheper
    }
}

if (!function_exists('removeCrap')) {
    function removeCrap($string)
    {
        return str_replace([',', '.', '-', '_', ' ', '(', ')'], '', $string);
    }
}

if (!function_exists('removeCrapWithSpacing')) {
    function removeCrapWithSpacing($string)
    {
        return trim(str_replace([',', '.', '-', '_', '(', ')', '@', ':', 'º', 'ª', '°'], '', $string));
    }
}

if (!function_exists('registerModelLog')) {
    function registerModelLog($repository, $subject_id, $log_type, $params = [])
    {
        $subject = $repository->find($subject_id, true);

        $log = activity()
            ->performedOn($subject)
            ->causedBy(user());

        if ($contract = optional($subject)->contract) {
            $log = $log->contract($contract);
        }

        if ($customer = optional($subject)->customer) {
            $log = $log->customer($customer);
        }

        if ($contract && !$customer) {
            $customer = $contract->customer;
            $log = $log->customer($customer);
        }

        if ($params != []) {
            $log = $log->withProperties($repository->filterAttributes($params));
        }

        $log = $log->log($log_type);
    }
}

if (!function_exists('addStyleInHtmlContent')) {
    function addStyleInHtmlContent($html, $template)
    {
        if (!$template->style) {
            return $html;
        }

        $resultHtml = $html;

        $dom = new \DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHtml($resultHtml);
        libxml_clear_errors();

        $head = $dom->getElementsByTagName('head')->item(0);
        $metaUtf8 = $dom->createElement("meta");
        $charsetAttribute = $dom->createAttribute('charset');
        $charsetAttribute->value = 'UTF-8';
        $metaUtf8->appendChild($charsetAttribute);
        $head->appendChild($metaUtf8);

        $style = $dom->createElement("style", $template->style);
        $head->appendChild($style);

        $resultHtml = $dom->savehtml();

        $resultHtml = str_replace(":first-of-type", ":nth-of-type(1)", $resultHtml);
        $resultHtml = str_replace(":last-of-type", ":nth-of-type(1)", $resultHtml);

        $cssToInlineStyles = new CssToInlineStyles();

        return $cssToInlineStyles->convert($resultHtml);
    }
}

if (!function_exists('getUrlsFromString')) {
    function getUrlsFromString($string)
    {
        $result = [];
        $regex = '/\bhttps?:\/\/[^\s,()<>]+(?:\{[^}]*\})?[^\s,()<>]*/';
        preg_match_all($regex, $string, $match);
        $urls = data_get($match, '0', []);
        foreach ($urls as $url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                if (preg_match_all('/\{(.*?)\}/', $url, $matches) == 0) {
                    $result[] = $url;
                }
            }
        }

        return $result;
    }
}

if (!function_exists('getUrlsWithVariablesFromString')) {
    function getUrlsWithVariablesFromString($string)
    {
        $result = [];
        $regex = '/\bhttps?:\/\/[^\s,()<>]+(?:\{[^}]*\})?[^\s,()<>]*/';
        preg_match_all($regex, $string, $match);
        $urls = data_get($match, '0', []);
        foreach ($urls as $url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                if (preg_match_all('/\{(.*?)\}/', $url, $matches) > 0) {
                    $result[] = $url;
                }
            }
        }

        return $result;
    }
}

if (!function_exists('getSmsSendVerbByStatus')) {
    function getSmsSendVerbByStatus($instance)
    {
        switch ($instance->status) {
            case SmsMessageQueue::STATUS_PENDING:
                return "será";
            case SmsMessageQueue::STATUS_SENT:
                return "foi";
            case SmsMessageQueue::STATUS_FAILED:
                return "seria";
            default:
                return "é";
        }
    }
}

if (!function_exists('getMediaContent')) {
    function getMediaContent(Media $media)
    {
        return config("filesystems.disks.{$media->disk}.driver") === 'local'
            ? file_get_contents($media->getPath())
            : Storage::disk($media->disk)->get($media->getPath());
    }
}

if (!function_exists('getModels')) {
    function getModels(): Collection
    {
        $models = collect(File::allFiles(app_path('Models')))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf(
                    '\%s%s',
                    Container::getInstance()->getNamespace() . 'Models\\',
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\')
                );

                return $class;
            })
            ->filter(function ($class) {
                $valid = false;

                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }

                return $valid;
            });

        return $models->values();
    }
}

if (!function_exists('compareASCII')) {
    function compareASCII($a, $b)
    {
        // Converte as letras acentuadas em letras não acentuadas
        $at = ltrim(iconv('UTF-8', 'ASCII//TRANSLIT', $a), "\'");
        $bt = ltrim(iconv('UTF-8', 'ASCII//TRANSLIT', $b), "\'");
        // Compara as chaves usando a ordem binária dos caracteres
        return strcmp($at, $bt);
    }
}

if (!function_exists('formatBRLToCurrency')) {
    function formatBRLToCurrency(mixed $string_number): float
    {
        if (is_int($string_number) || is_float($string_number)) {
            return $string_number;
        }

        $string_number = str_replace('.', '', $string_number);

        return floatval(str_replace(',', '.', $string_number));
    }
}

if (!function_exists('formatDecimalToCurrency')) {
    /**
     * Format a decimal value to Brazilian currency format.
     *
     * @param float $value
     * @param int $decimals
     * @return string
     */
    function formatDecimalToCurrency(float $value, int $decimals = 2): string
    {
        // Formata o valor para o formato de moeda brasileira
        return 'R$ ' . number_format($value, $decimals, ',', '.');
    }
}

if (!function_exists('processVariables')) {
    function processVariables($string)
    {
        $newString = $string;

        preg_match_all('/\{(.*?)\}/', $string, $matches);

        foreach ($matches[0] as $match) {
            $span = '<span class="variable" style="color: blue;">' . $match . '</span>';
            $newString = str_replace($match, $span, $newString);
        }

        return $newString;
    }
}

if (!function_exists('testsCastToJson')) {
    /**
     * Generate a raw DB query to search for a JSON field.
     *
     * @param  array|json  $json
     *
     * @throws \Exception
     *
     * @return \Illuminate\Database\Query\Builder
     */
    function testsCastToJson($json)
    {
        // Convert from array to json and add slashes, if necessary.
        if (is_array($json)) {
            $json = addslashes(json_encode($json, JSON_UNESCAPED_UNICODE));
        }
        // Or check if the value is malformed.
        elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception('A valid JSON string was not provided.');
        }
        return \DB::raw("CAST('{$json}' AS JSON)");
    }
}

if (!function_exists('is_date')) {
    /**
     * Generate a raw DB query to search for a JSON field.
     *
     * @param  array|json  $json
     *
     * @throws \Exception
     *
     * @return \Illuminate\Database\Query\Builder
     */
    function is_date($string, $format = 'Y-m-d H:i:s')
    {
        try {
            Carbon::createFromFormat($format, $string);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('validatePhone')) {
    /**
     * Generate a raw DB query to search for a JSON field.
     *
     * @param  array|json  $json
     *
     * @throws \Exception
     *
     * @return \Illuminate\Database\Query\Builder
     */
    function validatePhone($phone)
    {
        if (is_numeric($phone) && strlen($phone) == 11) {

            $ddd = intval(substr($phone, 0, 2));
            $number = intval(substr($phone, 2, 9));

            if (preg_match('/^9[1-9][0-9]{7}$/', $number)) {

                $ddds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61, 62, 63, 64, 65, 66, 67, 68, 69, 71, 73, 74, 75, 77, 79, 81, 82, 83, 84, 85, 86, 87, 88, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99];

                $ddd = intval(substr($phone, 0, 2));

                if (in_array($ddd, $ddds)) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (!function_exists('encodeURIComponent')) {
    function encodeURIComponent($str)
    {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
}

if (!function_exists('normalizeVariableValue')) {
    function normalizeVariableValue($value)
    {
        $newValue = $value;
        if ($newValue instanceof \Spatie\Html\Elements\A) {
            $newValue = (string) $newValue->toHtml();
        }

        return $newValue;
    }
}

if (!function_exists('buildProgressBar')) {
    function buildProgressBar($value)
    {
        $progress = '<span>' . $value . '%</span>';
        $progress .= '<div class="progress">';
        $progress .= '<div class="progress-bar" role="progressbar" style="width: ' . $value . '%" aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax="100"></div>';
        $progress .= '</div>';

        return $progress;
    }
}

if (!function_exists('removeAccents')) {
    function removeAccents($string)
    {
        $unwantedArray = [
            'á' => 'a',
            'à' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'ç' => 'c',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ñ' => 'n',
            'ó' => 'o',
            'ò' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'ÿ' => 'y',
            'Á' => 'A',
            'À' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Ç' => 'C',
            'É' => 'E',
            'È' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Í' => 'I',
            'Ì' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ó' => 'O',
            'Ò' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ú' => 'U',
            'Ù' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y'
        ];

        return strtr($string, $unwantedArray);
    }
}

if (!function_exists('fullStateName')) {
    function fullStateName($uf)
    {
        // NOTE: Retorna o nome completo do estado brasileiro de acordo com a UF
        $states = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ];

        return $states[strtoupper($uf)] ?? $uf;
    }
}

if (!function_exists('getAllStates')) {
    function getAllStates()
    {
        // NOTE: Retorna o nome completo do estado brasileiro de acordo com a UF
        $states = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ];

        return $states;
    }
}

if (!function_exists('externalRoute')) {
    /**
     * Substitui parâmetros em uma URL externa e retorna a URL formatada.
     *
     * @param string $url
     * @param array $parameters
     * @return string
     */
    function externalRoute($url, $parameters = [])
    {
        foreach ($parameters as $key => $value) {
            $url = str_replace('{' . $key . '}', $value, $url);
        }
        return $url;
    }
}

if (!function_exists('makeCheckoutUrl')) {
    /**
     * Constroi a URL do checkout
     *
     * @param bool $external
     * @return string
     */
    function makeCheckoutUrl(bool $external = false)
    {
        $base = env("VITE_CHECKOUT_URL", "https://checkout.amarassist.com.br/");
        if ($external) {
            return $base;
        }

        $user = auth()->user() ?? sistema();
        $agency = app(AgencyRepository::class)->findDefaultAgency();

        return $base . "?user_id={$user->id}&agency_id={$agency->id}&username={$user->name}&agency_name={$agency->fantasy_name}";
    }
}

if (!function_exists('extractPermission')) {
    /**
     * Extrai a permissão de uma Role para o formato de array
     */
    function extractPermission(Permission $permission)
    {
        $exploded = explode(' ', $permission->name);
        return [$exploded[0], $exploded[1]];
    }
}

if (!function_exists('getReportsRoutesArray')) {
    /**
     * Extrai um array com as rotas do relatórios
     */
    function getReportsRoutesArray($reports)
    {
        $items = [];
        foreach ($reports as $key => $report) {
            array_push($items, [
                'id' => $report['title'],
                'label' => $report['label'],
                'route' => 'web.admin.reports.slug',
                'route_params' => [
                    'slug' => $key
                ],
                'policy' => $report['policy']
            ]);
        }

        return $items;
    }
}

if (!function_exists('filterItemsWithPermissions')) {
    /**
     * Função recursiva para filtrar itens com base nas permissões
     */
    function filterItemsWithPermissions(array $items): array
    {
        $filteredItems = [];

        foreach ($items as $item) {
            $hasPermission = isset($item['permission']) && user()->can(...$item['permission']);

            $filteredSubItems = [];
            if (isset($item['items']) && is_array($item['items'])) {
                $filteredSubItems = filterItemsWithPermissions($item['items']);
            }

            if ($hasPermission || count($filteredSubItems) > 0) {
                $item['items'] = $filteredSubItems;
                $filteredItems[] = $item;
            }
        }

        return $filteredItems;
    }
}

if (!function_exists('removerAcentosECaracteresEspeciais')) {
    /**
     * Função para remover caracteres especiais e acentos
     */
    function removerAcentosECaracteresEspeciais(string $string): string
    {
        // Remove acentuação
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

        // Remove caracteres especiais, mantendo letras, números e espaços
        $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);

        // Remove espaços extras e retorna a string tratada
        return trim($string);
    }
}

if (!function_exists('getCurrentUserId')) {
    /**
     * Função para pegar o id do usuário da sessão atual (Caso não tenha nenhum usuário na sessão atual traz o sistema)
     */
    function getCurrentUserId(): int
    {
        $id = user()?->id ? user()?->id : sistema()?->id;

        return $id;
    }
}

if (!function_exists('carnivalDate')) {
    function carnivalDate($year)
    {
        $easter = Carbon::createFromFormat('Y-m-d', easterDate($year));

        $carnival = $easter->copy()->subDays(47);

        return [
            'saturday' => $carnival->copy()->subDays(3)->toDateString(),
            'sunday' => $carnival->copy()->subDays(2)->toDateString(),
            'monday' => $carnival->copy()->subDays(1)->toDateString(),
            'tuesday' => $carnival->toDateString()
        ];
    }
}

if (!function_exists('easterDate')) {
    function easterDate($year)
    {
        $a = $year % 19;
        $b = intdiv($year, 100);
        $c = $year % 100;
        $d = intdiv($b, 4);
        $e = $b % 4;
        $f = intdiv($b + 8, 25);
        $g = intdiv($b - $f + 1, 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = intdiv($c, 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = intdiv($a + 11 * $h + 22 * $l, 451);
        $month = intdiv($h + $l - 7 * $m + 114, 31);
        $day = (($h + $l - 7 * $m + 114) % 31) + 1;

        return sprintf("%04d-%02d-%02d", $year, $month, $day);
    }
}

if (!function_exists('debug_console')) {
    function debug_console($data)
    {
        $output = "\n🔍 DEBUG: " . print_r($data, true) . "\n";
        fwrite(STDERR, $output);
    }
}

if (!function_exists('debug_file')) {
    function debug_file($data)
    {
        $output = "[" . date('Y-m-d H:i:s') . "] 🔍 DEBUG: " . print_r($data, true) . PHP_EOL;
        file_put_contents(storage_path('logs/debug.log'), $output, FILE_APPEND);
    }
}
