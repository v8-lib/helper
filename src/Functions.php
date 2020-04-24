<?php
declare (strict_types=1);

use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\Utils\ApplicationContext;

if (false === function_exists('di')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param null|mixed $id
     *
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function di($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}


if (false === function_exists('format_throwable')) {
    /**
     * Format a throwable to string.
     *
     * @param Throwable $throwable
     *
     * @return string
     */
    function format_throwable(Throwable $throwable): string
    {
        return di()
            ->get(FormatterInterface::class)
            ->format($throwable);
    }
}


if (false === function_exists('yuan2fen')) {
    /**
     * 人民币元转为人民币分
     *
     * @param float $yuan
     *
     * @return integer
     */
    function yuan2fen($yuan): int
    {
        return (int)bcmul($yuan, 100);
    }
}


if (false === function_exists('fen2yuan')) {
    /**
     * 人民币分转为人民币元
     *
     * @param integer $fen
     *
     * @return float
     */
    function fen2yuan(int $fen)
    {
        return bcdiv($fen, 100, 2);
    }
}

if (false === function_exists('avgAmount')) {

    /**
     * 根据数组值占比，分摊总数尾差挂数组最后一元素
     *
     * $data = [ 123 => 500, 124 => 800]
     * @param int   $total
     * @param array $data
     *
     * @return array
     */
    function avgAmount(int $total, array $data): array
    {
        $avg = [];

        $ratioList = avgRatio($data);
        $diff      = $total;
        foreach ($data as $key => $item) {
            $avg[$key] = bcmul((string)$total, (string)$ratioList[$key]);
            $diff      = bcsub((string)$diff, $avg[$key]);
        }

        $keys = array_keys($data);
        $key  = end($keys);

        $avg[$key] += $diff;

        return $avg;
    }
}

if (false === function_exists('avgRatio')) {
    /**
     * 计算平均占比
     *
     * @param array $data
     *
     * @return array
     */
    function avgRatio(array $data): array
    {
        $total = array_sum($data);

        $return = [];
        foreach ($data as $key => $item) {
            $ratio = bcdiv((string)$item, (string)$total, 4);

            $return[$key] = $ratio;
        }

        return $return;
    }
}

if (false === function_exists('camelize')) {
    /**
     * 下划线转驼峰
     *
     * @param        $uncamelized_words
     * @param string $separator
     *
     * @return string
     */
    function camelize($uncamelized_words, $separator = '_')
    {
        $uncamelized_words = $separator . str_replace($separator, " ", strtolower($uncamelized_words));

        return ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $separator);
    }
}

if (false === function_exists('uncamelize')) {
    /**
     *  驼峰命名转下划线命名
     *
     * @param        $camelCaps
     * @param string $separator
     *
     * @return string
     */
    function uncamelize($camelCaps, $separator = '_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }
}