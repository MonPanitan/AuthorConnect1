<?php

namespace Book_storage;

class Genre
{
    private int $genreID;
    private String $genre_Name;

    public function __construct(int $genreID, String $genre_Name)
    {
        $this->genreID = $genreID;
        $this->genre_Name = $genre_Name;
    }

    /**
     * @return int
     */
    public function getGenreID(): int
    {
        return $this->genreID;
    }

    /**
     * @param int $genreID
     */
    public function setGenreID(int $genreID): void
    {
        $this->genreID = $genreID;
    }

    /**
     * @return String
     */
    public function getGenreName(): string
    {
        return $this->genre_Name;
    }

    /**
     * @param String $genre_Name
     */
    public function setGenreName(string $genre_Name): void
    {
        $this->genre_Name = $genre_Name;
    }


}