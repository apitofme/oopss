!!! ARCHIVED: whilst the idea had potential way back then I clearly didn't have the expertise. There are now much better methods and libraries to assist (plus Defvs really embraced the tools n0de and other platforms provided to complie and automate certain parts of the process ... who knew) !!!

# OOPSS
## stands for Object-Oriented PHP Stylesheets

The aim of this project is to establish a robust set of PHP classes designed to
make the construction and maintenance of Cascading Style Sheets (CSS) easier.

## What about LESS or SASS?
These are both popular CSS Pre-Processors which each implement their own take on
an enhanced, __non-standard__ extension to the default CSS language. They both
require interpreters in order to translate their enhanced syntax in to _native_
CSS! In my opinion this adds unnecessary additional demands on a developer just
to integrate these in to their development process. Demands such as...

	1. Learning new syntax and the specific nuances of the language(s).
	2. Runing additional development environments such as Ruby (LESS/SASS),
	NodeJS (LESS/SASS) or Compass (SASS only) in order to compile source files in to _native_ CSS.		
	3. Integration of these tools in to their development process.
	(something which may require developers to completely change the way they're used to working!)

Developers are busy people and I think that the time required to learn and
assimilate all of this in to their development processes can be seen as too
'expensive' and is therefor off putting.

### Motivations
My feeling was that if a developer has already invested the time in to learning
PHP (a well established, powerful, dynamic programming language) then why should
they have to spend more time learning other languages and tools which are far
too specific and limited in their purpose to be worthwhile?! The cost in terms
of time is simply not worth the pay-off for a _slightly_ more powerful stylesheet
syntax. They might as well just keep writting native CSS, since this is the end
result anyway, and instead invest their time implementing better 'best practices'
and optimisations in to their standard CSS development process.

### Reasoning
The advantage of writing stylesheets in PHP is that the code is executed and
compiled on the server before anything is sent to the browser, rather than using
'less.js' to compile LESS in to CSS on-the-fly client side using JavaScript
(with all of the associated overheads and page rendering issues). It also means
that a developer doesn't have to run their work through additional environments
such as Ruby, NodeJS or Compass just to compile the 'enhanced' source files in
to static CSS. By using OOPSS in PHP a developer can use the tools and programs
he is familiar with without having to install or configure anything extra!

### Goals
OOPSS intends to make developing and managing CSS for projects easier.
It also hopes to implement many of the advanced/enhanced features found in LESS
and SASS, but through PHP, and bring them to a wider audience by having a clear
and intuitive Object-Oriented approach to creating style sheets and style rules.


#### History
Development		v0.1_pre-alpha
Current				-


#### Legal
Copyright © 2013 Christopher Leaper
License LGPL v3.0 (see _'license.txt'_)
