CREATE TABLE Patient
(
  PatientID INT NOT NULL,
  Gender CHAR(1) NOT NULL,
  Ethnicity VARCHAR(100) NOT NULL,
  PRIMARY KEY (PatientID)
);

CREATE TABLE User (
  Username VARCHAR(16) NOT NULL,
  Email VARCHAR(255) NULL,
  Password VARCHAR(32) NOT NULL,
  Create_Time TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (Username));

CREATE TABLE Gender_Information
(
  Inheritance_Pattern VARCHAR(25) NOT NULL,
  Genetic_Diagnosis VARCHAR(40) NOT NULL,
  FamilyID INT NOT NULL,
  PatientID INT NOT NULL,
  PRIMARY KEY (FamilyID),
  FOREIGN KEY (PatientID) REFERENCES Patient(PatientID)
);

CREATE TABLE Family_Member
(
  Relationship VARCHAR(40) NOT NULL,
  MemberID INT NOT NULL,
  PatientID INT NOT NULL,
  FamilyID INT NOT NULL,
  PRIMARY KEY (MemberID),
  FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
  FOREIGN KEY (FamilyID) REFERENCES Gender_Information(FamilyID)
);

CREATE TABLE Method_of_Interpolation
(
  MethodID INT,
  Description VARCHAR(150),
  PRIMARY KEY (MethodID)
);

CREATE TABLE Audiogram
(
  Age INT NOT NULL,
  Date_of_Collection DATE NOT NULL,
  AudioPic VARCHAR(8000) NOT NULL,
  AudiogramID INT NOT NULL,
  PatientID INT NOT NULL,
  MethodID INT NOT NULL,
  PRIMARY KEY (AudiogramID),
  FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
  FOREIGN KEY (MethodID) REFERENCES Method_of_Interpolation(MethodID)
);

CREATE TABLE Hearing_Loss
(
  FrequencyID INT,
  Frequency FLOAT,
  dB_Loss FLOAT,
  Interpolated_Value INT,
  AudiogramID INT NOT NULL,
  PRIMARY KEY (FrequencyID),
  FOREIGN KEY (AudiogramID) REFERENCES Audiogram(AudiogramID)
);

