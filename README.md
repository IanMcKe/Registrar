# Salon database app with MySQL

##### Registrar App, 8/20/15

#### Ian McKenney & Jason Bethel

## Description

This application will a user to maintain a database of a university registrar.

## Setup

* First clone the repository using the line:
```console
$ git clone https://github.com/IanMcKe/Registrar.git
```
* In the project directory run the following to install the composer:
```console
$ composer install
```
* Start your local host in the web folder using:
```console
$ php -S localhost:8000
```
* Unzip **registrar.sql.zip** and **registrar_test.sql.zip** and import them to your local server.
* Navigate your browser to **localhost:8000**
* To run tests using PHPUnit, create a copy of the database called **registrar_test**


## Technologies Used

PHP, PHPUnit, Silex, Twig, Bootstrap and MySQL

### Legal

Copyright (c) 2015 Ian McKenney & Jason Bethel

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
