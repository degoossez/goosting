<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.googleincludes')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ setting('site.title') }}</title>

        <!-- File containing all layout/css/js includes -->
        @include('layouts.includes')

    </head>
    <body class="background-blog">
            <!-- Include navabar -->
            @include('layouts.navbar')
            <div class="container ">
                <div name="general_heading">
                    <h2 class="blog-header-text">
                        Qt, opencv & v4l cross compiling Raspberry Pi or Beagle bone
                    </h2>
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
                        <h3 class="blog-chapter-heading">
                            1. Download and install the cross compile toolchain
                        </h3>
                        <a class="blog-text">
                        Download an angstrom toolchain from <a href="http://web.archive.org/web/20130921065357/http://www.angstrom-distribution.org/toolchains/archive/" class="href-custom">http://web.archive.org/web/20130921065357/http://www.angstrom-distribution.org/toolchains/archive/</a> . <br>
                        We are going to use the x86_64-linux-armv7a-linux-gnueabi-toolchain-qte (64 bit) or i686-linux-armv7a-linux-gnueabi-toolchain-qte (32 bit).<br>
                        <br>    
                        Go to download directory and run the following command:<br>
                        </a>
                        <pre class="prettyprint pp-no-border">
    sudo tar -C / -xjf angstrom-2011.03-i686-linux-armv7a-linux-gnueabi-toolchain-qte-4.6.3.tar.bz2
                        </pre> 
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">
                            2. Download and install QT
                        </h3>
                        <a class="blog-text">
                            <li>Open a terminal and execute the following commands</li>
                        </a>
                        <pre class="prettyprint pp-no-border">
    cd ~/Downloads 
    wget http://download.qt.io/archive/qt/5.8/5.8.0/single/qt-everywhere-opensource-src-5.8.0.tar.gz
    tar -xzf qt-everywhere-opensource-src-5.8.0.tar.gz
    mv qt-everywhere-opensource-src-5.8.0 ~/qt-5.8.0-beagle
    cd ~/qt-5.8.0-beagle
    cp ./mkspecs/qws/linux-arm-g++/qplatformdefs.h ./mkspecs/qws/linux-am335x-g++
    touch ./mkspecs/qws/linux-am335x-g++/qmake.conf                      
                        </pre>
                        <a class="blog-text">
                            <li>Edit the qmake.conf (with gedit: sudo gedit ./mkspecs/qws/linux-am335x-g++/qmake.conf ) file with a text editor and change it to:</li>
                        </a>    
                        <pre class="prettyprint">
    #
    # qmake configuration for building with arm-linux-g++
    #
    
    include(../../common/linux.conf)
    include(../../common/gcc-base-unix.conf)
    include(../../common/g++-unix.conf)
    include(../../common/qws.conf)
    
    # modifications to g++.conf
    #Toolchain
    
    #Compiler Flags to take advantage of the ARM architecture
    QMAKE_CFLAGS_RELEASE = -O3 -march=armv7-a -mtune=cortex-a8 -mfpu=neon -mfloat-abi=softfp
    QMAKE_CXXFLAGS_RELEASE = -O3 -march=armv7-a -mtune=cortex-a8 -mfpu=neon -mfloat-abi=softfp
    
    QMAKE_CC = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/gcc
    QMAKE_CXX = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/g++
    QMAKE_LINK = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/g++
    QMAKE_LINK_SHLIB = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/g++
    
    # modifications to linux.conf
    QMAKE_AR = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/ar cqs
    QMAKE_OBJCOPY = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/objcopy
    QMAKE_STRIP = /usr/local/angstrom/arm/arm-angstrom-linux-gnueabi/bin/strip
    
    load(qt_config)
                        </pre>   
                        <a class="blog-text">
                            <li>Configure QT embedded</li>                              
                        </a>  
                        <pre class="prettyprint">  
    ./configure -v -opensource -confirm-license -prefix /opt/qt -embedded arm -platform qws/linux-x86-g++ -xplatform qws/linux-am335x-g++ -depths 16,24,32 -no-mmx -no-3dnow -no-sse -no-sse2 -no-glib -no-cups -no-largefile -no-accessibility -no-openssl -no-gtkstyle -qt-mouse-pc -qt-mouse-linuxtp -qt-mouse-linuxinput -plugin-mouse-linuxtp -plugin-mouse-pc -fast -little-endian -host-big-endian -no-pch -no-sql-ibase -no-sql-mysql -no-sql-odbc -no-sql-psql -no-sql-sqlite -no-sql-sqlite2 -no-webkit -no-qt3support -nomake examples -nomake demos -nomake docs -nomake translations     
                        </pre>
                        <a class="blog-text">
                            <li>Build and install</li>                               
                        </a>
                        <pre class="prettyprint">  
    make -j 4   
    sudo make install
                        </pre>                                      
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">
                            3. Prepare your Raspberry Pi or beagle bone for Qt
                        </h3>
                        <a class="blog-text">
                            <li>Connect your controller to your network</li>
                        </a>
                        <pre class="prettyprint">  
    ssh to your controller ssh accountname@ip => example: ssh pi@192.168.0.100
                        </pre>
                        <a class="blog-text">
                            <li>Create a dir structure on your controller</li>
                        </a>
                        <pre class="prettyprint">  
    sudo mkdir /opt
    sudo mkdir /opt/qt
                        </pre>
                        <a class="blog-text">
                            <li>Copy lib folder from host to controller</li>
                        </a>
                        <pre class="prettyprint">  
    scp -r /opt/qt/lib accountname@ip:”/opt/qt”
                        </pre>
                        <a class="blog-text">
                            <li>Add lib directory to your path</li>
                        </a>
                        <pre class="prettyprint">  
    PATH=$PATH:/opt/qt/lib
                        </pre>
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">
                            4. Dowload and install QT creator
                        </h3>
                        <a class="blog-text">
                            <li>Download qt-creator-linux-x86-opensource-2.8.0.run for x86 or qt-creator-linux-x86_64-opensource-2.8.0.run for 64bit</li>
                        <pre class="prettyprint"> 
    chmod +x qt-creator-linux-x86_64-opensource-2.8.0.run
    ./qt-creator-linux-x86_64-opensource-2.8.0.run
                        </pre>
                        <a class="blog-text">    
                            <li>Installation wizard</li>
                            <li>Run angstrom setup script</li>
                        </a>
                        <pre class="prettyprint"> 
    . /usr/local/angstrom/arm/environment-setup
                        </pre>
                        <a class="blog-text">    
                            Open Qt Creator and Configure Qt version
                            <ul>
                            <li>Go to Tools->Options->Build & Run->Qt Versions and click Add</li>
                            <li>Select qmake.conf from /opt/qt/bin</li>
                            <li>Click Ok</li>
                            <li>Configure target device connection</li>
                            <li>Go to Tools->Options->Devices</li>
                            <li>Click Add and select Generic Linux Device</li>
                            <li>Add IP 192.168.7.2, User: root</li>
                            <li>Set name to “Beaglebone”</li>
                            <li>Click Ok</li>
                            <li>Configure Compiler</li>
                            <li>Go to Tools->Options->Build & Run->Compilers and click Add->GCC</li>
                            <li>Select compiler path: /usr/local/angstrom/arm/bin/arm-angstrom-linux-gnueabi-g++</li>
                            <li>Click Ok</li>
                            <li>Configure Kit</li>
                            <li>Go to Tools->Options->Build & Run->Kits and click Add</li>
                            <li>Call new kit Beaglebone</li>
                            <li>Select device type: “Generic Linux Device”</li>
                            <li>Select the device you previously created</li>
                            <li>Select compiler you created</li>
                            <li>Select Qt version you created</li>
                            <li>Select GDK path as /usr/local/angstrom/arm/bin/arm-angstrom-linux-gnueabi-gdk</li>
                            <li>Click Ok</li>
                            </ul>
                        </a>
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">
                            5. Build an easy Qt program
                        </h3>
                        <a class="blog-text">     
                            <ul>
                                <li>Create new project (File->New project->Qt Project->Qt Console application)</li>
                                <li>Edit your project (.pro) file</li>
                                <li>Add the following after “TARGET=…” line:</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    target.files ="YOUR EXECUTABLE NAME"
    target.path = /home/root
    INSTALLS = target
                        </pre>
                        <a class="blog-text">     
                            <ul> 
                                <li>Go to Projects -> Run, you should see on “Files to deploy” table your “target” settings</li>
                                <li>Now you are ready to build and deploy you project on your target board</li>
                                <li>The following example application should print Hello world inside your console:</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    #include {{ "<QCoreApplication>" }}
    #include {{ "<iostream>" }}
    
    int main(int argc, char *argv[])
    {
        QCoreApplication a(argc, argv);
    
        std::cout << “hello world” << std::endl;
    
        return a.exec();
    }
                        </pre>
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">    
                            6. Adding OpenCV2.4 and v4l
                        </h3>
                        <a class="blog-text">  
                            <li>Install opencv on your computer (I use 2.4.1, it also works with all the newer versions)</li>
                        </a>
                        <pre class="prettyprint"> 
    sudo apt-get update && sudo apt-get upgrade && sudo apt-get install build-essential libgtk2.0-dev libjpeg-dev libtiff4-dev libjasper-dev libopenexr-dev cmake python-dev python-numpy python-tk libtbb-dev libeigen2-dev yasm libfaac-dev libopencore-amrnb-dev libopencore-amrwb-dev libtheora-dev libvorbis-dev libxvidcore-dev libx264-dev libqt4-dev libqt4-opengl-dev sphinx-common texlive-latex-extra libv4l-dev libdc1394-22-dev libavcodec-dev libavformat-dev libswscale-dev

    cd ~
    wget http://downloads.sourceforge.net/project/opencvlibrary/opencv-unix/2.4.1/OpenCV-2.4.1.tar.bz2 && tar -xvf OpenCV-2.4.1.tar.bz2
    cd OpenCV-2.4.1
    mkdir build
    cd build
    
    cmake -D WITH_TBB=ON -D BUILD_NEW_PYTHON_SUPPORT=ON -D WITH_V4L=ON -D INSTALL_C_EXAMPLES=ON -D INSTALL_PYTHON_EXAMPLES=ON -D BUILD_EXAMPLES=ON -D WITH_QT=ON -D WITH_OPENGL=ON .. 
    make -j4
    
    sudo make install
                        </pre>
                        <a class="blog-text">      
                            <li>Add to “/etc/ld.so.conf.d/opencv.conf” (file can be empty) the line /usr/local/lib</li>
                        </a>
                        <pre class="prettyprint"> 
    sudo gedit /etc/ld.so.conf.d/opencv.conf
    
    sudo ldconfig
                        </pre>
                        <a class="blog-text">      
                            <li>Add the following lines to /etc/bash.bashrc</li>
                        </a>
                        <pre class="prettyprint"> 
    PKG_CONFIG_PATH=$PKG_CONFIG_PATH:/usr/local/lib/pkgconfig
    export PKG_CONFIG_PATH
                        </pre>
                        <a class="blog-text">      
                            <li>Get the opencv arm library files</li>
                        </a>
                        <pre class="prettyprint"> 
    install cmake
    sudo apt-get install cmake cmake-curses-gui
                        </pre>
                        <a class="blog-text">      
                            <li>Add angstrom compiler to path</li>
                        </a>
                        <pre class="prettyprint"> 
    PATH=$PATH:/usr/local/angstrom/arm/bin/
                        </pre>
                        <a class="blog-text">      
                            <li>Download opencv2.4.1</li>
                        </a>
                        <pre class="prettyprint"> 
    cd ~
    mkdir OpenCV-2.4.1ARM
    cd OpenCV-2.4.1ARM
    wget http://downloads.sourceforge.net/project/opencvlibrary/opencv-unix/2.4.1/OpenCV-2.4.1.tar.bz2
    tar -xvf OpenCV-2.4.1.tar.bz2
    cd OpenCV-2.4.1ARM
    mkdir /build
    
    cd build
                        </pre>
                        <a class="blog-text">          
                            <li>Create toolchain file to tell the cross compiler how to compile</li>
                        </a>
                        <pre class="prettyprint"> 
    nano toolchain.cmake
                        </pre>
                        <a class="blog-text">      
                            <li>Add to the toolchain.cmake file</li>
                        </a>
                        <pre class="prettyprint"> 
    set( CMAKE_SYSTEM_NAME Linux )
    set( CMAKE_SYSTEM_PROCESSOR arm )
    set( CMAKE_C_COMPILER arm-angstrom-linux-gnueabi-gcc )
    set( CMAKE_CXX_COMPILER arm-angstrom-linux-gnueabi-g++ )
    set( CMAKE_FIND_ROOT_PATH ~/targetfs )
                        </pre>
                        <a class="blog-text">      
                            <li>Run cmake to generate the makefile:</li>
                        </a>
                        <pre class="prettyprint"> 
    cmake -DCMAKE_TOOLCHAIN_FILE=toolchain.cmake ../OpenCV-2.4.1ARM/
                        </pre>
                        <a class="blog-text">      
                            <li>Since this gives errors, we are going to use the gui to disable some settings</li>
                        </a>
                        <pre class="prettyprint"> 
    sudo apt-get install cmake-qt-gui
                        </pre>
                        <a class="blog-text">      
                            <li>Now run the cmake-qt-quit with: </li>
                        </a>
                        <pre class="prettyprint"> 
    cmake-gui .
                        </pre>
                        <a class="blog-text">  
                            Disable the following things (do not forget to chose “Advanced”)<br>
                            <ul>
                            <li>BUILD_NEW_PYTHON_SUPPORT</li>
                            <li>BUILD_TESTS</li>
                            <li>WITH_1394</li>
                            <li>WITH_CUDA</li>
                            <li>WITH_EIGEN2 (and WITH_EIGEN)</li>
                            <li>WITH_FFMPEG</li>
                            <li>WITH_GSTREAMER</li>
                            <li>WITH_GTK</li>
                            <li>WITH_JASPER</li>
                            <li>WITH_JPEG</li>
                            <li>WITH_OPENEXR</li>
                            <li>WITH_PNG</li>
                            <li>WITH_PVAPI</li>
                            <li>WITH_QT</li>
                            <li>WITH_QT_OPENGL</li>
                            <li>WITH_TBB</li>
                            <li>WITH_TIFF</li>
                            <li>WITH_UNICAP</li>
                            <li>WITH_V4L</li>
                            <li>WITH_XINE</li>
                            <li>Do a search on python and disable all of those too</li>
                            </ul>
                            <ul>
                                <li>First click on “Configure” , then “Generate”</li>
                                <li>Close it</li>
                                <li>Make opencv with the make command</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    make -j4
                        </pre>
                        <a class="blog-text"> 
                            Now we have the arm library’s we can start including them into our Qt project (example later in the tutorial)
                            <br>
                        </a>
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">
                            7. Install v4l on the raspberry PI
                        </h3>
                        <a class="blog-text"> 
                            Since all the essential information is on the site below, I will just redirect you to it.<br>
                            <a href="https://web.archive.org/web/20141208115847/http://www.linux-projects.org/modules/sections/index.php?op=viewarticle&artid=14" class="href-custom">https://web.archive.org/web/20141208115847/http://www.linux-projects.org/modules/sections/index.php?op=viewarticle&artid=14</a>     
                            <br> <br>                      
                            To always enable the v4l driver with the camera add “uv4l –driver raspicam –auto-video_nr –width 640 –height 480 –encoding jpeg” to the “~/.bashrc ” file  <br>
                        </a>                      
                    </p>
                    <p>
                        <h3 class="blog-chapter-heading">
                            8. Easy example program with Qt, opencv and v4l
                        </h3>
                        <a class="blog-text"> 
                                <ul><li>First create main.cpp</li></ul>
                        </a>
                        <pre class="prettyprint"> 
    #include {{ "<QCoreApplication>"}}
    #include {{ "<video.h>"}}
    #include {{ "<QDebug>"}}
    int main(int argc, char *argv[])
    {
    QCoreApplication a(argc, argv);
    Video vid;
    vid.Record();
    qDebug() << “Recording ended.\n”;
    return a.exec();
    }
                        </pre>
                        <a class="blog-text">     
                            <ul><li>Add a video.cpp file</li></ul>
                        </a>
                        <pre class="prettyprint"> 
    #include “video.h”
    #include {{ "<opencv/cv.h>"}}
    #include {{ "<opencv2/opencv.hpp>"}}
    #include {{ "<opencv2/core/core.hpp>"}}
    #include {{ "<opencv2/highgui/highgui.hpp>"}}
    #include {{ "<opencv/highgui.h>"}}
    
    #include “QString”
    #include “QDebug”
    
    using namespace cv;
    
    Video::Video(QObject *parent) :
    QObject(parent)
    {
        cam = new VideoCapture(0);
        if(!cam->isOpened()) qDebug() << “Cannot open Camera”;
        else qDebug() << “Camera open.”;
    }
    
    void Video::Record()
    {
    
        qDebug() << “Record\n”;
        double dWidth = cam->get(CV_CAP_PROP_FRAME_WIDTH); //get the width of frames of the video
        double dHeight = cam->get(CV_CAP_PROP_FRAME_HEIGHT); //get the height of frames of the video
        Size frameSize(static_cast{{ "<int>"}}(dWidth), static_cast{{ "<int>"}}(dHeight));
        qDebug() << “Frame Size = ” << dWidth << “x” << dHeight << “\n”;
        
        qDebug() << “Recording.\n”;
        Mat frame;
        qDebug() << “Made frame.\n”;
        cam->read(frame); // get a new frame from camera
        if(frame.data)
        {
            qDebug(“Image has data!”);
            QString Path = “/EmbeddedOS0.jpg”;
            QByteArray ba = Path.toLocal8Bit();
            const char *PathChar = ba.data();
            imwrite(PathChar,frame);
        }
    }                            
                        </pre>
                        <a class="blog-text">     
                            <ul><li>Add header file video.h</li></ul>
                        </a>
                        <pre class="prettyprint"> 
    #ifndef VIDEO_H
    #define VIDEO_H
    
    #include {{ "<QString>" }}
    #include {{ "<QObject>" }}
    #include “vector”
    
    #include {{ "<opencv/cv.h>" }}
    #include {{ "<opencv2/opencv.hpp>" }}
    #include {{ "<opencv2/core/core.hpp>" }}
    #include {{ "<opencv2/highgui/highgui.hpp>" }}
    #include {{ "<opencv/highgui.h>" }}
    
    using namespace cv;
    
    class Video: public QObject
    {
        private:
        VideoCapture *cam;
        public:
        explicit Video(QObject *parent = 0);
        void Record();
    };
    
    #endif // VIDEO_H
    
                        </pre>
                        <a class="blog-text">  
                            <ul>
                                <li>Add to your .pro file the following lines</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    INCLUDEPATH += /usr/local/include
                        </pre>
                        <a class="blog-text">     
                            <ul>
                                <li>Right click in your .pro file</li>
                                <li>Add library</li>
                                <li>External library</li>
                                <li>Library file</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    OpenCV-2.4.1ARM/build/lib/
                        </pre>
                        <a class="blog-text"> 
                            <ul>    
                                <li>Select libopencv_calib3d.so (if files are not found, look for them in the file manager and change .so.2.4 to .so)</li>
                                <li>Click away the windows and mac options</li>
                                <li>Next , finish</li>
                                <li>Directly after the -lopencv_calib3d add the following:  -lopencv_contrib -lopencv_core -lopencv_features2d -lopencv_flann -lopencv_highgui -lopencv_imgproc -lopencv_legacy -lopencv_ml -lopencv_objdetect -lopencv_ts -lopencv_video</li>
                                <li>It will be something like (files can be found in ~/OpenCV-2.4.1ARM/build/lib/ )</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    unix:!macx: LIBS += -L$$PWD/../../build/lib/ -lopencv_calib3d -lopencv_contrib -lopencv_core -lopencv_features2d -lopencv_flann -lopencv_highgui -lopencv_imgproc -lopencv_legacy -lopencv_ml -lopencv_objdetect -lopencv_ts -lopencv_video
                        </pre>
                        <a class="blog-text">     
                            <ul>
                                <li>Go to projects (on the left side bar)</li>
                                <li>You’ll see on the top the compilers you chose for this project, every compiler has a build and run button</li>
                                <li>Click on the run button (from the Cross Compiler)</li>
                                <li>If you scroll down you’ll see “Alternate executable on device” , check the box next to it and fill in:</li>
                            </ul>
                        </a>
                        <pre class="prettyprint"> 
    LD_PRELOAD=/usr/lib/uv4l/uv4lext/armv6l/libuv4lext.so {{ "<YOUREXECUTABLEFILENAM>" }}
                        </pre>
                        <a class="blog-text">     
                            HINT: {{ "<YOUREXECUTABLEFILENAME>" }} can be found above the box next to “Executable on device”
                            <br><br>
                            <ul>
                                <li>Go back to edit and press the run button</li>
                            </ul>
                            <br>You should now see this output (close the program with ctrl + c):
                            <br>
                        </a>
                        <pre class="prettyprint"> 
    Camera open.
    Record
    
    Frame Size = 480 x 480
    
    Recording.
    
    Made frame.
    
    Image has data!
    Recording ended.                            
                        </pre> 
                        <a class="blog-text">    
                            If you do ls -l in your root ( / ) folder, you will see an EmbeddedOS0.jpg file
                            <br>
                            <br>If you have any problems, first check the links below, there is a lot of information about it
                            <br>
                            <br><h4>SOURCES:</h4>
                            Most credits go to the people who made those tutorials. I used their work to make one bigger project:
                            <ul>
                                <li><a href="http://www.cloud-rocket.com/2013/07/building-qt-for-beaglebone/" class="href-custom">http://www.cloud-rocket.com/2013/07/building-qt-for-beaglebone/</a></li>
                                <li><a href="http://www.samontab.com/web/2012/06/installing-opencv-2-4-1-ubuntu-12-04-lts/" class="href-custom">http://www.samontab.com/web/2012/06/installing-opencv-2-4-1-ubuntu-12-04-lts/</a></li>
                                <li><a href="http://processors.wiki.ti.com/index.php/Building_OpenCV_for_ARM_Cortex-A8" class="href-custom">http://processors.wiki.ti.com/index.php/Building_OpenCV_for_ARM_Cortex-A8</a></li>
                            </ul>
                        </a>
                    </p>
                </div>
            </div>
    </body>
</html>
