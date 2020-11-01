<?php

    class Company
    {
        private $company_name, $job_name, $job_description, $job_hourly_rate, $foreign_key;

        function construct($company_name, $job_name, $job_description, $job_hourly_rate, $foreign_key){
            $this->company_name = $company_name;
            $this->job_name = $job_name;
            $this->job_description = $job_description;
            $this->job_hourly_rate = $job_hourly_rate;
            $this->foreign_key = $foreign_key;
        }

        function setCompanyName($company_name){
            $this->company_name = $company_name;
        }

        function setJobName(){
            $this->job_name = $job_name;
        }

        function setJobDescription(){
            $this->job_description = $job_description;
        }

        function setHourlyRate(){
            $this->job_hourly_rate = $job_hourly_rate;
        }

        function setForeignKey(){
            $this->foreign_key = $foreign_key;
        }
        function getCompanyName(){
            return $company_name;
        }

        function getJobName(){
            return $job_name;
        }

        function getJobDescriptoin(){
            return $job_description;    
        }

        function getHourlyRate(){
            return $job_hourly_rate;
        }

        function getForeignKey(){
            return $foreign_key;
        }
    }
?>