SELECT * FROM Applicant WHERE CreditScore > 700;

SELECT * FROM LoanApplication WHERE Status = 'Pending';

SELECT * FROM Loan WHERE LoanTerm > 24;

SELECT Name, Email FROM Applicant;

SELECT LoanAmount, LoanType FROM LoanApplication WHERE Status = 'Approved';

SELECT A.Name, LA.LoanAmount, LA.LoanType, LA.Status
FROM Applicant A
JOIN LoanApplication LA ON A.ApplicantID = LA.ApplicantID;

SELECT L.LoanID, A.Name, L.LoanAmount, L.InterestRate, L.LoanTerm
FROM Loan L
JOIN LoanApplication LA ON L.ApplicationID = LA.ApplicationID
JOIN Applicant A ON LA.ApplicantID = A.ApplicantID;

SELECT AVG(LoanAmount) AS AvgLoanAmount FROM LoanApplication;


SELECT SUM(LoanAmount) AS TotalApprovedLoans FROM LoanApplication WHERE Status = 'Approved';

SELECT COUNT(*) AS ApplicantsAbove650 FROM Applicant WHERE CreditScore > 650;

SELECT Name, CreditScore 
FROM Applicant 
WHERE CreditScore = (SELECT MAX(CreditScore) FROM Applicant);

SELECT A.Name, LA.LoanAmount, LA.Status
FROM Applicant A
JOIN LoanApplication LA ON A.ApplicantID = LA.ApplicantID
WHERE A.AnnualIncome > (SELECT AVG(AnnualIncome) FROM Applicant);

INSERT INTO Applicant (Name, DateOfBirth, Address, ContactNumber, Email, EmploymentStatus, AnnualIncome, CreditScore)
VALUES ('Alice Johnson', '1989-03-25', '123 Maple St', '555-6789', 'alice.j@example.com', 'Employed', 85000.00, 710);

INSERT INTO LoanApplication (ApplicantID, LoanAmount, LoanType, ApplicationDate, Status)
VALUES (1, 30000.00, 'Auto', '2025-01-15', 'Pending');

SELECT * FROM Applicant;

SELECT * FROM LoanApplication;

Copy code
UPDATE LoanApplication 
SET Status = 'Approved' 
WHERE ApplicationID = 1;

UPDATE Applicant 
SET CreditScore = 750 
WHERE ApplicantID = 2;

DELETE FROM LoanApplication WHERE ApplicationID = 5;

DELETE FROM Applicant WHERE ApplicantID = 3;

SELECT LoanType, MAX(LoanAmount) AS MaxLoanAmount
FROM LoanApplication
GROUP BY LoanType;

SELECT A.Name, SUM(LA.LoanAmount) AS TotalLoans
FROM Applicant A
JOIN LoanApplication LA ON A.ApplicantID = LA.ApplicantID
GROUP BY A.Name;

SELECT AVG(InterestRate) AS AvgInterestRate
FROM Loan
WHERE LoanTerm > 12;

SELECT L.LoanID, P.RemainingBalance
FROM Loan L
JOIN Payment P ON L.LoanID = P.LoanID
WHERE P.RemainingBalance < 10000.00;

SELECT EmploymentStatus, COUNT(*) AS Count
FROM Applicant
GROUP BY EmploymentStatus
ORDER BY Count DESC
LIMIT 1;