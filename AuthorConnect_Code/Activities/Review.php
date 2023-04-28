<?php
    class Review extends AuthorPost
    {
        public int $reviewID;
        public Date $date;
        public String $comment;

        //will contain UserID

    }