<?php
namespace App\Helpers;

use Illuminate\Support\Carbon;
use App\Repositories\Calendar\CalendarRepositoryInterface;

class Utils
{
    protected $calendarRepository;

    public function __construct(CalendarRepositoryInterface $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    /**
     * [3桁~4桁の数字をコンマ月のtime型で返す]
     *
     * @param integer $time
     * @return void
     */
    public function formattedTime(int $time)
    {
        return Carbon::parse(sprintf('%04d', $time))->format('H:i');
    }

    /**
     * [日付をまたいでいても営業時間が終了していなかったら一日前に戻す]
     *
     * @param string $targetDate
     * @return void
     */
    public function checkBuissnesTime(string $targetDate)
    {
        $date = Carbon::parse($targetDate);
        // $borderLowDateTime = $date->copy()->startOfDay();
        $borderHighDateTime = $date->copy()->startOfDay()->addHour(config('const.DIAGRAM_START_HOUR'))->addMinute(config('const.DIAGRAM_START_MINUTES'));
        if ($date < $borderHighDateTime) {
            $date->subDay(1);
        }

        return $date;
    }

    /**
     * [カレンダーtableでの値の有無によって平日or土休を返す]
     *
     * @param string $date
     * @param int $sectionNumber
     * @return void
     */
    public function getDayType(string $date, int $sectionNumber)
    {
        $date = $this->checkBuissnesTime($date);

        $isExistsDaType = $this->calendarRepository->isExistsSearchByDate($date->format('Y-m-d'), $sectionNumber);
        return $isExistsDaType ? config('const.DAY_TYPE.HOLIDAY') : config('const.DAY_TYPE.NORMAL');
    }

    /**
     * [API送信成功時のフォーマット整形]
     *
     * @param array $data
     * @return void
     */
    public function formattedApiSuccessResponse($data)
    {
        $res = [
            'data' => $data,
            'error' => [
                'code' => null,
                'message' => null,
            ],
        ];

        return $res;
    }
}
