

for file in {01..13}; do
    echo Extracting $file...
    convert -crop 5x2@ original/MF_T-$file.jpg result/X$file%d.png
done
