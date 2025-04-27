import sys
import json
import os
from pdftext.extraction import plain_text_output, table_output

if len(sys.argv) == 2:
    input_path = sys.argv[1]
else:
    print(json.dumps({'error': 'Incorrect number of arguments'}), file=sys.stderr)
    sys.exit(1)

input_path = sys.argv[1]
data = {}

# Debugging statements using stderr
print("Python Script: Checking file path:", input_path, file=sys.stderr)
print("Python Script: Does file exist?", os.path.exists(input_path), file=sys.stderr)

if not os.path.exists(input_path):
    print(json.dumps({'error': 'File does not exist'}), file=sys.stderr)
    sys.exit(1)

# Handle .docx conversion
# DOCX to PDF conversion
if input_path.lower().endswith(".docx"):
    try:
        from docx2pdf import convert
        from pathlib import Path

        output_pdf = Path(input_path).with_suffix('.pdf')
        print("Converting DOCX to PDF...", file=sys.stderr)

        convert(input_path)  # creates the PDF in the same directory
        input_path = str(output_pdf)  # update the path to the new PDF
        print("Input path after conversion:", input_path, file=sys.stderr)
        if not os.path.exists(input_path):
            raise FileNotFoundError(f"PDF conversion failed or file not found: {output_pdf}")
        print("DOCX conversion completed", file=sys.stderr)

    except Exception as e:
        error_message = f'DOCX to PDF conversion failed: {str(e)}'
        print(json.dumps({'error': error_message}), file=sys.stderr)
        sys.exit(1)


# Attempt PDF extraction
try:
    text = plain_text_output(input_path)
    if text:
        print(json.dumps({'output': {'text': text}}), file=sys.stdout)
    else:
        print(json.dumps({'error': 'No text extracted'}), file=sys.stderr)
        sys.exit(1)

except Exception as e:
    print(json.dumps({'error': str(e)}), file=sys.stderr)
    sys.exit(1)
