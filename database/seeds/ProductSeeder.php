<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        App\Product::create(['title' => 'Clean Code', 'cost' => 10.99, 'desc' => 'Even bad code can function. But if code isnt clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code. ...', 'available' => 1]);
        App\Product::create(['title' => 'The Pragmatic Programmer', 'cost' => 20.60, 'desc' => 'The Pragmatic Programmer: From Journeyman to Master is a book about computer programming and software engineering, written by Andrew Hunt and David Thomas and published in October 1999. It is used as a textbook in related university courses. Wikipedia', 'available' => 1]);
        App\Product::create(['title' => 'Refactoring', 'cost' => 19.99, 'desc' => ' Fully Revised and Updated–Includes New Refactorings and Code Examples “Any fool can write code that a computer can understand. Good programmers write code that humans can understand.” ...', 'available' => 1]);
        App\Product::create(['title' => 'The Art of Computer Programming', 'cost' => 15.50, 'desc' => 'The Art of Computer Programming is a comprehensive monograph written by computer scientist Donald Knuth that covers many kinds of programming algorithms and their analysis. Knuth began the project, originally conceived as a single book with twelve chapters, in 1962.', 'available' => 0]);
        App\Product::create(['title' => 'The Mythical Man-Month', 'cost' => 30.00, 'desc' => 'The Mythical Man-Month: Essays on Software Engineering is a book on software engineering and project management by Fred Brooks first published in 1975, with subsequent editions in 1982 and 1995. Its central theme is that "adding manpower to a late software project makes it later."', 'available' => 1]);
        App\Product::create(['title' => 'Working Effectively with Legacy Code', 'cost' => 25.99, 'desc' => 'This book provides programmers with the ability to cost effectively handlecommon legacy code problems without having to go through the hugelyexpensive task of rewriting all existing code. It describes a series of practicalstrategies that developers can employ to bring their existing softwareapplications under control.', 'available' => 1]);
    }
}
