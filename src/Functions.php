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
     * 计算平均金额，并将平均数和尾差都返回
     */
    function avgAmount(int $total, array $data): array
    {
        return [];
    }
}

if (false === function_exists('avgRatio')) {
    /**
     * 计算平均占比
     */
    function avgRatio(int $total, array $data): array
    {
        return [];
    }
}