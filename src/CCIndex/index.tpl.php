<h1>Index Controller</h1>
<p>Welcome to Molly index controller.</p>

<h2>Download</h2>
<p>You can download Molly from github.</p>
<blockquote>
<code>git clone git://github.com/henknordin/molly.git</code>
</blockquote>
<p>You can review its source directly on github: <a href='https://github.com/henknordin/molly'>https://github.com/henknordin/molly</a></p>

<h2>Installation</h2>
<p>First you have to make the data-directory writable. This is the place where Molly needs
to be able to write and create files.</p>
<blockquote>
<code>cd molly; chmod 777 site/data</code>
</blockquote>
<p>
If you use the student server, you need to use RewriteBase in the .htaccess-file. 
Point it to the directory of your installation.
<blockquote>
<code>RewriteBase /change/this/to/site/base/url/if/needed/</code>
</blockquote>
</p>

<p>Thirdly, Molly has some modules that need to be initialised. You can do this through a
controller. Point your browser to the following link.</p>
<blockquote>
<a href='<?=create_url('module/install')?>'>module/install</a>
</blockquote>
