# pip install PyPDF2
# pip install spacy
# pip install Flask
# python -m spacy download en_core_web_lg


import PyPDF2
import spacy
import sys
import os

def convert_pdf_to_text(pdf_path, text_path):
    with open(pdf_path, 'rb') as pdf_file:
        pdf_reader = PyPDF2.PdfReader(pdf_file)
        num_pages = len(pdf_reader.pages)
        with open(text_path, 'w', encoding='utf-8') as text_file:
            for page_number in range(num_pages):
                page = pdf_reader.pages[page_number]
                text_file.write(page.extract_text())

# Get the path of the uploaded PDF file from the command line arguments
pdf_file_path = sys.argv[1]
text_file_path = sys.argv[2]

# Get the full paths to the files
full_pdf_path = os.path.join(os.getcwd(), pdf_file_path)
full_text_path = os.path.join(os.getcwd(), text_file_path)

# Call the function to convert PDF to text
convert_pdf_to_text(full_pdf_path, full_text_path)

nlp = spacy.load("en_core_web_lg")
skill_pattern_path = "cv_analyzer/jz_skill_patterns.jsonl"  # Assuming it is in the same directory

ruler = nlp.add_pipe("entity_ruler")

if os.path.exists(skill_pattern_path):
    ruler.from_disk(skill_pattern_path)
else:
    print(f"Error: File not found - {skill_pattern_path}")


def get_skills(text):
    doc = nlp(text)
    myset = []
    subset = []
    for ent in doc.ents:
        if ent.label_ == "SKILL":
            subset.append(ent.text)
    myset.append(subset)
    return subset

def unique_skills(x):
    return list(set(x))

# Read the text from the file
with open(text_file_path, 'r', encoding='utf-8') as text_file:
    input_resume = text_file.read()

# Display the content of the text file
# print("Resume Content:")
# print(input_resume)

resume_skills = unique_skills(get_skills(input_resume.lower()))

formatted_skills = ", ".join(resume_skills)
print(formatted_skills)

#print(resume_skills, rs)








            # // Api call for recommended jobs
            # try {
            #     //  replace $job variable with the output of skills extracted

            #     $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad");

            #     // for ($i = 0; $i < 10; $i++) {
            #     // $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=.$i");
            #     // }
            # } catch (\Exception $e) {

