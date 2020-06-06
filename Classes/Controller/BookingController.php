<?php

/**
 * BookingController.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Controller;

use Checkitsedo\Calendarize\Domain\Model\Index;
use Checkitsedo\Calendarize\Domain\Model\Request\AbstractBookingRequest;

/**
 * BookingController.
 */
class BookingController extends AbstractController
{
    /**
     * Form action.
     *
     * @param \Checkitsedo\Calendarize\Domain\Model\Index $index
     */
    public function bookingAction(Index $index = null)
    {
        $this->view->assign('index', $index);

        $this->slotExtendedAssignMultiple([
            'index' => $index,
        ], __CLASS__, __FUNCTION__);
    }

    /**
     * Send action.
     *
     * @param Index                                                          $index
     * @param \Checkitsedo\Calendarize\Domain\Model\Request\AbstractBookingRequest $request
     *
     * @validate $request \Checkitsedo\Calendarize\Validation\Validator\BookingRequestValidator
     */
    public function sendAction(Index $index, AbstractBookingRequest $request)
    {
        $request->setIndex($index);

        // Use the Slot to handle the request

        $this->slotExtendedAssignMultiple([
            'request' => $request,
        ], __CLASS__, __FUNCTION__);
    }
}
