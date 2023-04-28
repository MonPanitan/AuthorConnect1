<?php

class AuthorPost
{
    public int $postID;
    public string $Heading;
    public string $Description;
    public string $date;


    public function __construct(string $Heading, string $Description, string $date)
    {
        $this->Heading = $Heading;
        $this->Description = $Description;
        $this->date = $date;
    }

    protected int $postTypeID = 0;

    /**
     * @return Date
     */
    public function getDate(): Date
    {
        $date = date('Y-m-d H:i:s');
        return $this->date;
    }

    /**
     * @param Date $date
     */
    public function setDate(Date $date): void
    {

    }


}
