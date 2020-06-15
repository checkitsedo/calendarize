<?php

/**
 * Event (Default) for the calendarize function.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Domain\Model;

use Checkitsedo\Calendarize\Features\FeedInterface;
use Checkitsedo\Calendarize\Features\KeSearchIndexInterface;
use Checkitsedo\Calendarize\Features\SpeakingUrlInterface;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Event (Default) for the calendarize function.
 *
 * @db
 * @smartExclude Workspaces
 */
class Event extends AbstractModel implements FeedInterface, SpeakingUrlInterface, KeSearchIndexInterface
{
    /**
     * Title.
     *
     * @var string
     * @db
     */
    protected $title;

    /**
     * Subtitle.
     *
     * @var string
     * @db
     */
    protected $subtitle;

    /**
     * Description.
     *
     * @var string
     * @db
     * @enableRichText
     */
    protected $description;

    /**
     * Location.
     *
     * @var string
     * @db
     */
    protected $location;

    /**
     * Location link.
     *
     * @var string
     * @db
     */
    protected $locationLink;

    /**
     * Organizer.
     *
     * @var string
     * @db
     */
    protected $organizer;

    /**
     * Organizer link.
     *
     * @var string
     * @db
     */
    protected $organizerLink;

    /**
     * Import ID if the item is based on an ICS structure.
     *
     * @var string
     * @db
     */
    protected $importId;

    /**
     * Artist.
     *
     * @var string
     * @db
     */
    protected $artist;
    
    /**
     * Artist link.
     *
     * @var string
     * @db
     */
    protected $artistLink;
    
    /**
     * Artist description.
     *
     * @var string
     * @db
     */
    protected $artistDescription;
    
    /**
     * Instructor.
     *
     * @var string
     * @db
     */
    protected $instructor;
    
    /**
     * Instructor link.
     *
     * @var string
     * @db
     */
    protected $instructorLink;
    
    /**
     * Instructor description.
     *
     * @var string
     * @db
     */
    protected $instructorDescription;
    
    /**
     * Event language.
     *
     * @var string
     * @db
     */
    protected $eventLanguage;
    
    /**
     * Free entry.
     *
     * @var bool
     * @db
     */
    protected $freeEntry;

    /**
     * Collection.
     *
     * @var bool
     * @db
     */
    protected $collection;
    
    /**
     * Collection reference.
     *
     * @var string
     * @db
     */
    protected $collectionReference;
    
    /**
     * Registration required.
     *
     * @var bool
     * @db
     */
    protected $registrationRequired;

    /**
     * Price standard.
     *
     * @var string
     * @db
     */
    protected $priceStandard;
    
    /**
     * Price reduced.
     *
     * @var string
     * @db
     */
    protected $priceReduced;
    
    /**
     * Booking required.
     *
     * @var bool
     * @db
     */
    protected $bookingRequired;

    /**
     * External booking.
     *
     * @var bool
     * @db
     */
    protected $externalBooking;

    /**
     * Booking link.
     *
     * @var string
     * @db
     */
    protected $bookingLink;
    
    /**
     * Images.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @db
     * @lazy
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $images;

    /**
     * Downloads.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @db
     * @lazy
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $downloads;

    /**
     * Relation field. It is just used by the importer of the default events.
     * You do not need this field, if you don't use the default Event.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Checkitsedo\Calendarize\Domain\Model\Configuration>
     */
    protected $calendarize;

    /**
     * Categories.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

    /**
     * Hidden.
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * Build up the object.
     */
    public function __construct()
    {
        $this->calendarize = new ObjectStorage();
        $this->images = new ObjectStorage();
        $this->downloads = new ObjectStorage();
        $this->categories = new ObjectStorage();
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get subtitle.
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set subtitle.
     *
     * @param string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get downloads.
     *
     * @return ObjectStorage
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * Set downloads.
     *
     * @param ObjectStorage $downloads
     */
    public function setDownloads($downloads)
    {
        $this->downloads = $downloads;
    }

    /**
     * Get images.
     *
     * @return ObjectStorage
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set images.
     *
     * @param ObjectStorage $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * Get Import ID.
     *
     * @return string
     */
    public function getImportId()
    {
        return $this->importId;
    }

    /**
     * Set import ID.
     *
     * @param string $importId
     */
    public function setImportId($importId)
    {
        $this->importId = $importId;
    }

    /**
     * Get calendarize.
     *
     * @return ObjectStorage
     */
    public function getCalendarize()
    {
        return $this->calendarize;
    }

    /**
     * Set calendarize.
     *
     * @param ObjectStorage $calendarize
     */
    public function setCalendarize($calendarize)
    {
        $this->calendarize = $calendarize;
    }

    /**
     * Add one calendarize configuration.
     *
     * @param Configuration $calendarize
     */
    public function addCalendarize($calendarize)
    {
        $this->calendarize->attach($calendarize);
    }

    /**
     * Get the feed title.
     *
     * @return string
     */
    public function getFeedTitle(): string
    {
        return (string)$this->getTitle();
    }

    /**
     * Get the feed abstract.
     *
     * @return string
     */
    public function getFeedAbstract(): string
    {
        return (string)$this->getFeedContent();
    }

    /**
     * Get the feed content.
     *
     * @return string
     */
    public function getFeedContent(): string
    {
        return (string)$this->getDescription();
    }

    /**
     * Get the feed location.
     *
     * @return string
     */
    public function getFeedLocation(): string
    {
        return (string)$this->getLocation();
    }

    /**
     * Get the base for the realurl alias.
     *
     * @return string
     */
    public function getRealUrlAliasBase(): string
    {
        return (string)$this->getTitle();
    }

    /**
     * Adds a Category.
     *
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a Category.
     *
     * @param Category $categoryToRemove The Category to be removed
     */
    public function removeCategory(Category $categoryToRemove)
    {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories.
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets the categories.
     *
     * @param ObjectStorage $categories
     */
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the title.
     *
     * @param Index $index
     *
     * @return string
     */
    public function getKeSearchTitle(Index $index): string
    {
        return (string)$this->getTitle() . ' - ' . $index->getStartDate()
                ->format('d.m.Y');
    }

    /**
     * Get the abstract.
     *
     * @param Index $index
     *
     * @return string
     */
    public function getKeSearchAbstract(Index $index): string
    {
        return (string)$this->getDescription();
    }

    /**
     * Get the content.
     *
     * @param Index $index
     *
     * @return string
     */
    public function getKeSearchContent(Index $index): string
    {
        return (string)$this->getDescription();
    }

    /**
     * Get the tags.
     *
     * @param Index $index
     *
     * @return string Comma separated list of tags, e.g. '#syscat1#,#syscat2#'
     */
    public function getKeSearchTags(Index $index): string
    {
        static $keSearchTags = [];
        if (empty($keSearchTags)) {
            foreach ($this->getCategories() as $category) {
                $keSearchTags[] = "#syscat{$category->getUid()}#";
            }
        }

        return \implode(',', $keSearchTags);
    }

    /**
     * Get location.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location.
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get organizer.
     *
     * @return string
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Set organizer.
     *
     * @param string $organizer
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * Is hidden.
     *
     * @return bool
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * Set hidden.
     *
     * @param bool $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * Get location link.
     *
     * @return string
     */
    public function getLocationLink()
    {
        return $this->locationLink;
    }

    /**
     * Set location link.
     *
     * @param string $locationLink
     */
    public function setLocationLink($locationLink)
    {
        $this->locationLink = $locationLink;
    }

    /**
     * Get organizer link.
     *
     * @return string
     */
    public function getOrganizerLink()
    {
        return $this->organizerLink;
    }

    /**
     * Set organizer link.
     *
     * @param string $organizerLink
     */
    public function setOrganizerLink($organizerLink)
    {
        $this->organizerLink = $organizerLink;
    }
    
    /**
     * Get artist.
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set artist.
     *
     * @param string $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * Get artist link.
     *
     * @return string
     */
    public function getArtistLink()
    {
        return $this->artistLink;
    }

    /**
     * Set artist link.
     *
     * @param string $artistLink
     */
    public function setArtistLink($artistLink)
    {
        $this->artistLink = $artistLink;
    }
    
    /**
     * Get artist description.
     *
     * @return string
     */
    public function getArtistDescription()
    {
        return $this->artist;
    }

    /**
     * Set artist description.
     *
     * @param string $artistDescription
     */
    public function setArtistDescription($artistDescription)
    {
        $this->artistDescription = $artistDescription;
    }

    /**
     * Get instructor.
     *
     * @return string
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * Set instructor.
     *
     * @param string $instructor
     */
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }
    
    /**
     * Get instructor link.
     *
     * @return string
     */
    public function getInstructorLink()
    {
        return $this->instructorLink;
    }

    /**
     * Set instructor link.
     *
     * @param string $instructorLink
     */
    public function setInstructorLink($instructorLink)
    {
        $this->instructorLink = $instructorLink;
    }

    /**
     * Get instructor description.
     *
     * @return string
     */
    public function getInstructorDescription()
    {
        return $this->instructorDescription;
    }

    /**
     * Set instructor description.
     *
     * @param string $instructorDescription
     */
    public function setInstructorDescription($instructorDescription)
    {
        $this->instructorDescription = $instructorDescription;
    }

    /**
     * Get event language.
     *
     * @return string
     */
    public function getEventLanguage()
    {
        return $this->eventLanguage;
    }

    /**
     * Set event language.
     *
     * @param string $eventLanguage
     */
    public function setEventLanguage($eventLanguage)
    {
        $this->eventLanguage = $eventLanguage;
    }
    
    /**
     * Is free entry.
     *
     * @return bool
     */
    public function isFreeEntry()
    {
        return (bool)$this->freeEntry;
    }

    /**
     * Set free entry.
     *
     * @param bool $freeEntry
     */
    public function setFreeEntry($freeEntry)
    {
        $this->freeEntry = (bool)$freeEntry;
    }
	
    /**
     * Is collection.
     *
     * @return bool
     */
    public function isCollection()
    {
        return (bool)$this->collection;
    }

    /**
     * Set collection.
     *
     * @param bool $collection
     */
    public function setCollection($collection)
    {
        $this->collection = (bool)$collection;
    }

    /**
     * Get collection reference.
     *
     * @return string
     */
    public function getCollectionReference()
    {
        return $this->collectionReference;
    }

    /**
     * Set collection reference.
     *
     * @param string $collectionReference
     */
    public function setCollectionReference($collectionReference)
    {
        $this->collectionReference = $collectionReference;
    }

    /**
     * Is registration required.
     *
     * @return bool
     */
    public function isRegistrationRequired()
    {
        return (bool)$this->registrationRequired;
    }

    /**
     * Set registration required.
     *
     * @param bool $registrationRequired
     */
    public function setRegistrationRequired($registrationRequired)
    {
        $this->registrationRequired = (bool)$registrationRequired;
    }
	
    /**
     * Get price standard.
     *
     * @return string
     */
    public function getPriceStandard()
    {
        return $this->priceStandard;
    }

    /**
     * Set price standard.
     *
     * @param string $priceStandard
     */
    public function setPriceStandard($priceStandard)
    {
        $this->priceStandard = $priceStandard;
    }

    /**
     * Get price reduced.
     *
     * @return string
     */
    public function getPriceReduced()
    {
        return $this->priceReduced;
    }

    /**
     * Set price reduced.
     *
     * @param string $priceReduced
     */
    public function setPriceReduced($priceReduced)
    {
        $this->priceReduced = $priceReduced;
    }
    
    /**
     * Is booking required.
     *
     * @return bool
     */
    public function isBookingRequired()
    {
        return (bool)$this->bookingRequired;
    }

    /**
     * Set booking required.
     *
     * @param bool $bookingRequired
     */
    public function setBookingRequired($bookingRequired)
    {
        $this->bookingRequired = (bool)$bookingRequired;
    }	
    
    /**
     * Is external booking.
     *
     * @return bool
     */
    public function isExternalBooking()
    {
        return (bool)$this->externalBooking;
    }

    /**
     * Set external booking.
     *
     * @param bool $externalBooking
     */
    public function setExternalBooking($externalBooking)
    {
        $this->externalBooking = (bool)$externalBooking;
    }	
    
    /**
     * Get booking link.
     *
     * @return string
     */
    public function getBookingLink()
    {
        return $this->bookingLink;
    }

    /**
     * Set booking link.
     *
     * @param string $bookingLink
     */
    public function setBookingLink($bookingLink)
    {
        $this->bookingLink = $bookingLink;
    }
}
