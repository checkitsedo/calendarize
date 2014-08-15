<?php
/**
 * Calendar
 *
 * @category   Extension
 * @package    Calendarize
 * @subpackage Controller
 * @author     Tim Lochmüller
 */

namespace HDNET\Calendarize\Controller;

use HDNET\Calendarize\Domain\Model\Index;
use TYPO3\CMS\Extensionmanager\Controller\ActionController;

/**
 * Calendar
 *
 * @package    Calendarize
 * @subpackage Controller
 * @author     Tim Lochmüller
 */
class CalendarController extends ActionController {

	/**
	 * The index repository
	 *
	 * @var \HDNET\Calendarize\Domain\Repository\IndexRepository
	 * @inject
	 */
	protected $indexRepository;

	/**
	 * List action
	 */
	public function listAction() {
		$this->view->assign('indices', $this->indexRepository->findList());
	}

	/**
	 * Year action
	 *
	 * @param int $year
	 */
	public function yearAction($year = NULL) {
		if ($year === NULL) {
			$year = date('Y');
		}
		$this->view->assign('indices', $this->indexRepository->findYear($year));

	}

	/**
	 * Month action
	 *
	 * @param int $year
	 * @param int $month
	 */
	public function monthAction($year = NULL, $month = NULL) {
		if ($year === NULL) {
			$year = date('Y');
		}
		if ($month === NULL) {
			$month = date('m');
		}
		$this->view->assign('indices', $this->indexRepository->findMonth($year, $month));

	}

	/**
	 * Week action
	 *
	 * @param int $year
	 * @param int $week
	 */
	public function weekAction($year = NULL, $week = NULL) {
		if ($year === NULL) {
			$year = date('Y');
		}
		if ($week === NULL) {
			$week = date('W');
		}
		$this->view->assign('indices', $this->indexRepository->findWeek($year, $week));

	}

	/**
	 * Day action
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 */
	public function dayAction($year = NULL, $month = NULL, $day = NULL) {
		if ($year === NULL) {
			$year = date('Y');
		}
		if ($month === NULL) {
			$month = date('m');
		}
		if ($day === NULL) {
			$day = date('d');
		}
		$todayTimestamp = mktime(12, 0, 0, $month, $day, $year);
		$today = new \DateTime($todayTimestamp);
		$previous = clone $today;
		$previous->modify('-1 day');
		$next = clone $today;
		$next->modify('+1 day');
		$this->view->assignMultiple(array(
			'indices'  => $this->indexRepository->findDay($year, $month, $day),
			'today'    => $today,
			'previous' => $previous,
			'next'     => $next,
		));
	}

	/**
	 * Detail action
	 *
	 * @param \HDNET\Calendarize\Domain\Model\Index $index
	 */
	public function detailAction(Index $index = NULL) {
		if ($index === NULL) {
			$this->redirect('list', NULL, NULL, array());
		}
		$this->view->assign('index', $index);
	}

}
 