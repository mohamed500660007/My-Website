@extends('layouts.app')

@section('title', 'Portfolio - بنبني منتجات رقمية تصنع الفرق')

@section('content')
    <x-sections.hero />
    <x-sections.projects :projects="$projects" />
    <x-sections.services />
    <x-sections.about />
    <x-sections.blog />
    <x-sections.testimonials />
    <x-sections.newsletter />
    <x-sections.contact />
@endsection
