<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 offset-md-1">Technology</div>
    </div>
</div>
<div class="container">
    <div name="general_heading">
        <h1 class="postheader">
            Qt + opencv + v4l cross compiling Raspberry Pi / Beagle bone
        </h1>
        <p>
            <h3>
                System information:
            </h3>
            <ul>
                <li>Ubuntu 13.10 - 64 bit </li>
                <li>Raspberry PI with Raspbian</li>
                <li>g++ complier (install using: sudo apt-get install g++)</li>
            </ul>
        </p>
        <p>
            <h3>
                1. Download and install the cross compile toolchain
            </h3>
            <a class="blog-text">
            Down an angstrom toolchain from http://web.archive.org/web/20130921065357/http://www.angstrom-distribution.org/toolchains/archive/ . <br>
            We are going to use the x86_64-linux-armv7a-linux-gnueabi-toolchain-qte (64 bit) or i686-linux-armv7a-linux-gnueabi-toolchain-qte (32 bit).<br>
            <br>    
            Go to download directory and run the following command:<br>
            </a>
            <a class="terminal-command">
            sudo tar -C / -xjf angstrom-2011.03-i686-linux-armv7a-linux-gnueabi-toolchain-qte-4.6.3.tar.bz2
            </a>    
        </p>
    </div>
</div>