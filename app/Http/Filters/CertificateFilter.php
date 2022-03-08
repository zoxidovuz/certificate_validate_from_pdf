<?php

namespace App\Http\Filters;

class CertificateFilter extends QueryFilter
{
    public function vat(string $vat):void
    {
        $this->builder->where('vat', 'like', "%$vat%");
    }

    public function nameSociety(string $name_society):void
    {
        $this->builder->where('name_society', 'like', "%$name_society%");
    }

    public function dateCertificate(string $date_certificate):void
    {
        $this->builder->where('date_certificate', $date_certificate);
    }
}
